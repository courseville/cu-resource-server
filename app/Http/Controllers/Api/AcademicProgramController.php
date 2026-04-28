<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\AcademicProgramResource;
use App\Models\Resources\AcademicProgram;
use Illuminate\Http\Request;

class AcademicProgramController extends ResourceController
{
    protected function modelClass(): string
    {
        return AcademicProgram::class;
    }

    protected function resourceClass(): string
    {
        return AcademicProgramResource::class;
    }

    /**
     * Display a listing of the academic programs.
     *
     * @response AnonymousResourceCollection<AcademicProgramResource>
     */
    public function index(Request $request)
    {
        // return parent::index($request);
        $modelClass = $this->modelClass();
        $resourceClass = $this->resourceClass();

        // Check permission
        $permissionService = app(PermissionService::class);
        $client = auth('api')->client();
        $viewableColumns = $permissionService->allowedColumns($client, 'view', $modelClass);
        if (empty($viewableColumns)) {
            abort(403, 'No permission to view any columns');
        }

        // Initialize the query builder with viewable columns
        $builder = $modelClass::select($viewableColumns);

        // Search on searchable columns
        if (method_exists($modelClass, 'getSearchable')) {
            $searchableAttributes = (new $modelClass)->getSearchable();
            $builder = $this->searchByAttributes($request, $builder, ...$searchableAttributes);
        }

        // Apply pagination
        $request->page = $request->integer('page', 1);
        $data = $builder->paginate($request->integer('n', 10));

        return AcademicProgramResource::collection($data);
    }

    /**
     * Display the specified academic program.
     *
     * @response AcademicProgramResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
