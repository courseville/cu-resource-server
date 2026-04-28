<?php

namespace App\Http\Controllers;

use App\Models\PkModel;
use App\Services\PermissionService;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

abstract class ResourceController extends Controller
{
    use Searchable;

    /**
     * Get the model class for the resource.
     */
    abstract protected function modelClass(): string;

    /**
     * Get the resource class for the resource.
     */
    protected function resourceClass(): string
    {
        // Default fallback or should be abstract?
        // Let's make it abstract to force child classes to define it for Scramble.
        return \Illuminate\Http\Resources\Json\JsonResource::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $modelClass = $this->modelClass();
        $resourceClass = $this->resourceClass();

        // Check if the table exists
        if (! Schema::hasTable((new $modelClass)->getTable())) {
            abort(404, 'Table not found');
        }

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

        return $resourceClass::collection($data);
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
    public function show(string $id)
    {
        $modelClass = $this->modelClass();
        $resourceClass = $this->resourceClass();

        // Check if the table exists
        if (! Schema::hasTable((new $modelClass)->getTable())) {
            abort(404, 'Table not found');
        }

        // Check primary key from PkModel
        $modelPk = PkModel::where('model', '=', $modelClass)->first();
        $primaryKey = $modelPk->primary_key ?? 'id';

        // Check permission
        $permissionService = app(PermissionService::class);
        $client = auth('api')->client();
        $viewableColumns = $permissionService->allowedColumns($client, 'view', $modelClass);
        if (empty($viewableColumns)) {
            abort(403, 'No permission to view any columns');
        }

        $data = $modelClass::select($viewableColumns)->where($primaryKey, $id)->firstOrFail();

        return new $resourceClass($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
