<?php

namespace App\Http\Controllers\Resources;

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
        if (method_exists($this->modelClass, 'getSearchable')) {
            $searchableAttributes = (new $this->modelClass)->getSearchable();
            $builder = $this->searchByAttributes($request, $builder, ...$searchableAttributes);
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
}
