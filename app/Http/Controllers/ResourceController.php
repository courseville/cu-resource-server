<?php

namespace App\Http\Controllers;

use App\Models\PkModel;
use App\Services\PermissionService;
use App\Traits\Paginatable;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Str;

class ResourceController extends Controller
{
    use Paginatable, Searchable;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $entity)
    {
        // Check if the table exists
        if (! Schema::hasTable($entity)) {
            abort(404, 'Table not found');
        }

        $modelClass = 'App\\Models\\Resources\\'.Str::studly(Str::singular($entity));

        if (! class_exists($modelClass)) {
            abort(404, 'Model not found');
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
    public function show(string $entity, string $id)
    {
        // Check if the table exists
        if (! Schema::hasTable($entity)) {
            abort(404, 'Table not found');
        }

        $modelClass = 'App\\Models\\Resources\\'.Str::studly(Str::singular($entity));
        if (! class_exists($modelClass)) {
            abort(404, 'Model not found');
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
}
