<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\StudentResource;
use App\Models\Resources\Student;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class StudentController extends ResourceController
{
    protected function modelClass(): string
    {
        return Student::class;
    }

    protected function resourceClass(): string
    {
        return StudentResource::class;
    }

    /**
     * Display a listing of the students.
     *
     * @response AnonymousResourceCollection<StudentResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified student.
     *
     * @response StudentResource
     */
    public function show(string $id)
    {
        // For students, the "id" in the route is actually student_code
        $modelClass = $this->modelClass();
        $resourceClass = $this->resourceClass();

        // Check permission
        $client = auth('api')->client();
        $permissionService = app(PermissionService::class);
        $viewableColumns = $permissionService->allowedColumns($client, 'view', $modelClass);
        if (empty($viewableColumns)) {
            abort(403, 'No permission to view any columns');
        }

        $data = Student::select($viewableColumns)->where('student_code', $id)->firstOrFail();

        return new StudentResource($data);
    }

    /**
     * Export students to CSV or XLSX.
     */
    public function export(Request $request)
    {
        // Check permission
        $client = auth('api')->client();
        $permissionService = app(PermissionService::class);
        $viewableColumns = $permissionService->allowedColumns($client, 'view', Student::class);
        if (empty($viewableColumns)) {
            abort(403, 'No permission to view any columns');
        }

        // Initialize the query builder
        $builder = Student::select($viewableColumns);

        // Search on searchable columns
        if (method_exists(Student::class, 'getSearchable')) {
            $searchableAttributes = (new Student)->getSearchable();
            $queryStr = $request->string('name', $request->string('q', ''));
            if ($queryStr !== '') {
                $builder->searchByAttributes($queryStr, ...$searchableAttributes);
            }
        }

        $students = $builder->get();
        $format = $request->query('format', 'csv');

        if ($format === 'xlsx') {
            return $this->exportXlsx($students, $viewableColumns);
        }

        return $this->exportCsv($students, $viewableColumns);
    }

    protected function exportCsv($data, $columns)
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

    protected function exportXlsx($data, $columns)
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
