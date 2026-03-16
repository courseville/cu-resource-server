<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resources\Student;
use App\Services\PermissionService;
use App\Traits\Searchable;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use Searchable;

    protected $modelClass;

    protected $permissionService;

    public function __construct(
        PermissionService $permissionService,
    ) {
        $this->modelClass = Student::class;
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the students.
     */
    public function index(Request $request)
    {
        // Check permission
        $client = auth('api')->client();
        $viewableColumns = $this->permissionService->allowedColumns($client, 'view', $this->modelClass);
        if (empty($viewableColumns)) {
            abort(403, 'No permission to view any columns');
        }

        // Initialize the query builder with viewable columns
        $builder = $this->modelClass::select($viewableColumns);

        // Search on searchable columns
        if (method_exists($this->modelClass, 'getSearchable') && $request->has('q')) {
            $searchableAttributes = (new $this->modelClass)->getSearchable();
            $builder->searchByAttributes($request->query('q'), ...$searchableAttributes);
        }

        // Apply pagination
        $request->page = $request->integer('page', 1);
        $data = $builder->paginate($request->integer('n', 10));

        return response()->json($data);
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
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
    public function export(Request $request)
    {
        // Check permission
        $client = auth('api')->client();
        $viewableColumns = $this->permissionService->allowedColumns($client, 'view', $this->modelClass);
        if (empty($viewableColumns)) {
            abort(403, 'No permission to view any columns');
        }

        // Initialize the query builder
        $builder = $this->modelClass::select($viewableColumns);

        // Search on searchable columns
        if (method_exists($this->modelClass, 'getSearchable') && $request->has('q')) {
            $searchableAttributes = (new $this->modelClass)->getSearchable();
            $builder->searchByAttributes($request->query('q'), ...$searchableAttributes);
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
        $filename = "students_" . date('Ymd_His') . ".csv";
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
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
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

        $filename = "students_" . date('Ymd_His') . ".xlsx";
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
