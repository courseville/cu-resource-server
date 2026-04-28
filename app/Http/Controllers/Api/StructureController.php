<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\StructureResource;
use App\Models\Resources\Structure;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class StructureController extends ResourceController
{
    protected function modelClass(): string
    {
        return Structure::class;
    }

    protected function resourceClass(): string
    {
        return StructureResource::class;
    }

    /**
     * Display a listing of the structures.
     *
     * @response AnonymousResourceCollection<StructureResource>
     */
    public function index(Request $request)
    {
        // Check permission
        $client = auth('api')->client();
        $permissionService = app(PermissionService::class);
        $viewableColumns = $permissionService->allowedColumns($client, 'view', Structure::class);
        if (empty($viewableColumns)) {
            abort(403, 'No permission to view any columns');
        }

        // Initialize the query builder with viewable columns
        $builder = Structure::query();
        $builder->select($viewableColumns);

        // Apply filters if any
        $params = $request->validate([
            'structure_id' => 'string',
        ]);

        // Search on searchable columns
        $searchableAttributes = (new Structure)->getSearchable();
        $builder->searchByAttributes(
            $request->string('name', ''),
            ...$searchableAttributes
        );

        $request->page = $request->integer('page', 1);
        $data = $builder->paginate($request->integer('n', 10));

        return StructureResource::collection($data);
    }

    /**
     * Display the specified structure.
     *
     * @response StructureResource
     */
    public function show(string $id)
    {
        $modelClass = $this->modelClass();
        $resourceClass = $this->resourceClass();

        // Check permission
        $client = auth('api')->client();
        $permissionService = app(PermissionService::class);
        $viewableColumns = $permissionService->allowedColumns($client, 'view', $modelClass);
        if (empty($viewableColumns)) {
            abort(403, 'No permission to view any columns');
        }

        $structure = Structure::select($viewableColumns)->where('structure_id', $id)->firstOrFail();

        return new StructureResource($structure);
    }
}
