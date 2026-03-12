<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Filament\Actions\ImportAction as BaseImportAction;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExcelImportAction extends BaseImportAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $reflection = new \ReflectionClass(BaseImportAction::class);
        $schemaProperty = $reflection->getProperty('schema');
        $schemaProperty->setAccessible(true);
        $parentSchema = $schemaProperty->getValue($this);

        $this->schema(function (ExcelImportAction $action) use ($parentSchema) {
            $components = value($parentSchema, $action);

            foreach ($components as $component) {
                if ($component instanceof FileUpload && $component->getName() === 'file') {
                    $component
                        ->label('Upload a CSV or XLSX file')
                        ->placeholder('Select or drag a CSV or XLSX file here')
                        ->acceptedFileTypes([
                            'text/csv',
                            'text/x-csv',
                            'application/csv',
                            'application/x-csv',
                            'text/comma-separated-values',
                            'text/x-comma-separated-values',
                            'text/plain',
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        ]);
                }
            }

            return $components;
        });

        $this->registerModalActions([
            Action::make('downloadExcelExample')
                ->label('Download example XLSX file')
                ->link()
                ->action(function (): StreamedResponse {
                    $columns = $this->getImporter()::getColumns();
                    $spreadsheet = new Spreadsheet;
                    $sheet = $spreadsheet->getActiveSheet();

                    // Set Headers
                    foreach ($columns as $index => $column) {
                        $sheet->setCellValueByColumnAndRow($index + 1, 1, $column->getExampleHeader());
                    }

                    // Set Example Data
                    $columnExamples = array_map(fn ($column) => $column->getExamples(), $columns);
                    $maxRows = array_reduce($columnExamples, fn ($max, $ex) => max($max, count($ex)), 0);

                    for ($row = 0; $row < $maxRows; $row++) {
                        foreach ($columnExamples as $colIndex => $examples) {
                            $sheet->setCellValueByColumnAndRow($colIndex + 1, $row + 2, $examples[$row] ?? '');
                        }
                    }

                    return response()->streamDownload(function () use ($spreadsheet) {
                        $writer = new Xlsx($spreadsheet);
                        $writer->save('php://output');
                    }, (string) str($this->getImporter())->classBasename()->kebab().'-example.xlsx', [
                        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    ]);
                }),
        ]);
    }

    /**
     * @return resource | false
     */
    public function getUploadedFileStream(TemporaryUploadedFile $file)
    {
        $extension = strtolower($file->getClientOriginalExtension());

        if (in_array($extension, ['xls', 'xlsx'])) {
            $csvFile = $this->convertToCsv($file);

            if (! $csvFile) {
                return false;
            }

            // Use the newly created TemporaryUploadedFile for the stream
            return parent::getUploadedFileStream($csvFile);
        }

        $resource = parent::getUploadedFileStream($file);

        if (! is_resource($resource)) {
            return false;
        }

        return $resource;
    }

    protected function convertToCsv(TemporaryUploadedFile $file): ?TemporaryUploadedFile
    {
        try {
            // Load the Excel file
            $reader = IOFactory::createReaderForFile($file->getRealPath());
            $spreadsheet = $reader->load($file->getRealPath());

            // Use the first sheet as requested
            $sheet = $spreadsheet->getSheet(0);
            $sheetName = $sheet->getTitle();

            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

            // Heuristic to find the header row: scan first 10 rows and pick the one with most columns
            $bestHeaderRow = 1;
            $maxColumnsFound = 0;
            $rowsToScan = min(10, $highestRow);

            for ($row = 1; $row <= $rowsToScan; $row++) {
                $colsInRow = 0;
                for ($col = 1; $col <= $highestColumnIndex; $col++) {
                    if (filled($sheet->getCell([$col, $row])->getValue())) {
                        $colsInRow++;
                    }
                }

                if ($colsInRow > $maxColumnsFound) {
                    $maxColumnsFound = $colsInRow;
                    $bestHeaderRow = $row;
                }
            }

            \Illuminate\Support\Facades\Log::info("ExcelImportAction: Detected header row {$bestHeaderRow} in sheet '{$sheetName}' with {$maxColumnsFound} columns.");

            // Remove rows before the header row
            if ($bestHeaderRow > 1) {
                $sheet->removeRow(1, $bestHeaderRow - 1);
            }

            // Recalculate highest column for the NOW-first row (the detected header row)
            $newHighestColumnIndex = 0;
            for ($col = 1; $col <= $highestColumnIndex; $col++) {
                if (filled($sheet->getCell([$col, 1])->getValue())) {
                    $newHighestColumnIndex = $col;
                }
            }

            // If there are empty columns after the last header, remove them
            if ($newHighestColumnIndex < $highestColumnIndex) {
                $sheet->removeColumnByIndex($newHighestColumnIndex + 1, $highestColumnIndex - $newHighestColumnIndex);
            }

            // Remove completely empty rows to avoid importing blank records
            $highestRow = $sheet->getHighestRow();
            $removedRowsCount = 0;
            for ($row = $highestRow; $row >= 1; $row--) {
                $isEmpty = true;
                for ($col = 1; $col <= $newHighestColumnIndex; $col++) {
                    if (filled($sheet->getCell([$col, $row])->getValue())) {
                        $isEmpty = false;
                        break;
                    }
                }
                if ($isEmpty) {
                    $sheet->removeRow($row);
                    $removedRowsCount++;
                }
            }

            \Illuminate\Support\Facades\Log::info("ExcelImportAction: Removed {$removedRowsCount} empty rows. Final row count: ".$sheet->getHighestRow());

            // Create a temporary CSV path
            $csvFilename = 'livewire-tmp/'.(string) str()->uuid().'.csv';
            $disk = config('livewire.temporary_file_upload.disk') ?: config('filesystems.default');
            $csvPath = Storage::disk($disk)->path($csvFilename);

            if (! file_exists(dirname($csvPath))) {
                mkdir(dirname($csvPath), 0755, true);
            }

            // Save as CSV
            $writer = IOFactory::createWriter($spreadsheet, 'Csv');
            if ($writer instanceof Csv) {
                $writer->setUseBOM(true);
            }
            $writer->save($csvPath);

            return TemporaryUploadedFile::createFromLivewire(basename($csvFilename));

        } catch (\Exception $e) {
            report($e);

            return null;
        }
    }

    public function getFileValidationRules(): array
    {
        $rules = parent::getFileValidationRules();

        // Remove the default 'extensions:csv,txt' rule so we can add our own
        $rules = array_filter($rules, function ($rule) {
            return ! is_string($rule) || ! str_starts_with($rule, 'extensions:');
        });

        // Add back support for csv, txt, xls, xlsx
        array_unshift($rules, 'extensions:csv,txt,xls,xlsx');

        return $rules;
    }
}
