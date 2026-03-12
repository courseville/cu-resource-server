<?php

namespace App\Http\Controllers;

use App\Models\PkModel;
use App\Services\PermissionService;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Str;

class ResourceController extends Controller
{
    use Searchable;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $entity = null)
    {
        $entity = $entity ?? $request->segment(3);
        
        // Find model class
        $modelClass = $this->resolveModelClass($entity);

        if (! $modelClass || ! class_exists($modelClass)) {
            abort(404, 'Model not found for entity: ' . $entity);
        }

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
    public function show(string $entity, string $id = null)
    {
        // If entity looks like an ID (numeric or long string), it might be the second param redirected
        if (is_null($id)) {
            $id = $entity;
            $entity = request()->segment(3);
        }

        $modelClass = $this->resolveModelClass($entity);
        if (! $modelClass || ! class_exists($modelClass)) {
            abort(404, 'Model not found');
        }

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

        $data = $modelClass::select($viewableColumns)->where($primaryKey, $id)->first();

        return response()->json($data);
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

    protected function resolveModelClass(string $entity): ?string
    {
        $singular = Str::studly(Str::singular($entity));
        
        $namespaces = [
            'App\\Models\\Resources\\',
            'App\\Models\\',
        ];

        foreach ($namespaces as $namespace) {
            $class = $namespace . $singular;
            if (class_exists($class)) {
                return $class;
            }
        }

        return null;
    }
}
