<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Resources\Student;
use App\Services\PermissionService;
use App\Traits\Paginatable;
use App\Traits\Searchable;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use Paginatable, Searchable;

    protected $modelClass;

    protected $permissionService;

    public function __construct(
        PermissionService $permissionService,
    ) {
        $this->modelClass = Student::class;
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
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
        $data = $this->paginatableGet($builder, $request);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
