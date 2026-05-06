<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\StudentResource;
use App\Models\Resources\Student;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StudentController extends BaseResourceController
{
    protected string $model = Student::class;

    protected string $resource = StudentResource::class;

    /**
     * Display a listing of the students.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $viewableColumns = $this->validatePermission('view');

        // Initialize the query builder with viewable columns
        $builder = Student::query()->select($viewableColumns);

        // Search on searchable columns
        $this->applySearch($builder, $request);

        return StudentResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student): StudentResource
    {
        $this->validatePermission('view');

        return new StudentResource($student);
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Student $student)
    {
        //
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        //
    }

    /**
     * Export students to CSV or XLSX.
     */
    public function export(BaseResourceRequest $request): StreamedResponse
    {
        // Check permission
        $viewableColumns = $this->validatePermission('view');

        // Initialize the query builder
        $builder = Student::query()->select($viewableColumns);

        // Search on searchable columns
        $this->applySearch($builder, $request);

        $students = $builder->get();
        $format = $request->query('format', 'csv');

        if ($format === 'xlsx') {
            return $this->exportXlsx($students, $viewableColumns);
        }

        return $this->exportCsv($students, $viewableColumns);
    }

    protected function exportCsv($data, $columns): StreamedResponse
    {
        $filename = 'students_'.date('Ymd_His').'.csv';
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

    protected function exportXlsx($data, $columns): StreamedResponse
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

        $filename = 'students_'.date('Ymd_His').'.xlsx';
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
