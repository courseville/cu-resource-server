<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseResourceRequest;
use App\Services\PermissionService;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\StreamedResponse;

abstract class BaseResourceController extends Controller
{
    /**
     * The model class for this resource.
     */
    protected string $model;

    /**
     * The resource class for this resource.
     */
    protected string $resource;

    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected PermissionService $permissionService,
    ) {}

    /**
     * Validate permissions and return viewable columns.
     */
    protected function validatePermission(string $action = 'view'): array
    {
        $client = auth('api')->client();
        $viewableColumns = $this->permissionService->allowedColumns($client, $action, $this->model);

        if (empty($viewableColumns)) {
            abort(403, 'No permission to view any columns');
        }

        return $viewableColumns;
    }

    /**
     * Get the query builder for the resource.
     */
    protected function getBuilder(BaseResourceRequest $request): Builder
    {
        $viewableColumns = $this->validatePermission('view');

        $builder = $this->model::query()->select($viewableColumns);

        $this->applySearch($builder, $request);

        return $builder;
    }

    /**
     * Export the resource data to CSV or XLSX format.
     */
    public function export(BaseResourceRequest $request): StreamedResponse
    {
        $builder = $this->getBuilder($request);

        $data = $builder->get();
        $format = $request->query('format', 'csv');
        $viewableColumns = $this->validatePermission('view');

        $filenamePrefix = strtolower(class_basename($this->model));

        if ($format === 'xlsx') {
            return $this->exportXlsx($data, $viewableColumns, $filenamePrefix);
        }

        return $this->exportCsv($data, $viewableColumns, $filenamePrefix);
    }

    protected function exportCsv($data, $columns, $filenamePrefix): StreamedResponse
    {
        $filename = $filenamePrefix.'_'.now()->format('Ymd_His').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $row) {
                $rowData = [];
                foreach ($columns as $column) {
                    $rowData[] = $row->{$column};
                }
                fputcsv($file, $rowData);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    protected function exportXlsx($data, $columns, $filenamePrefix): StreamedResponse
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        // Add headers
        foreach ($columns as $index => $column) {
            $sheet->setCellValue([$index + 1, 1], $column);
        }

        // Add data
        foreach ($data as $rowIndex => $row) {
            foreach ($columns as $colIndex => $column) {
                $sheet->setCellValue([$colIndex + 1, $rowIndex + 2], $row->{$column});
            }
        }

        $filename = $filenamePrefix.'_'.now()->format('Ymd_His').'.xlsx';
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /**
     * Apply search criteria to the query builder.
     *
     * @param  BaseResourceRequest  $request
     */
    protected function applySearch(Builder $builder, $request): void
    {
        if (method_exists($this->model, 'getSearchable')) {
            $searchableAttributes = (new $this->model)->getSearchable();
            $builder->searchByAttributes(
                $request->string('name', ''),
                ...$searchableAttributes
            );
        }
    }
}
