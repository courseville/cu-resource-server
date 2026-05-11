<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\StructureResource;
use App\Models\Resources\Structure;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StructureController extends BaseResourceController
{
    protected string $model = Structure::class;

    protected string $resource = StructureResource::class;

    /**
     * Display a listing of the structures.
     */
    public function index(\Illuminate\Http\Request $request): AnonymousResourceCollection
    {
        $viewableColumns = $this->validatePermission('view');

        // Initialize the query builder with viewable columns
        $builder = Structure::query()->select($viewableColumns);

        if ($request->filled('structure_id')) {
            $builder->where('structure_id', $request->structure_id);
        }

        // Search on searchable columns
        $this->applySearch($builder, $request);

        return StructureResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Store a newly created structure in storage.
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified structure.
     */
    public function show(Structure $structure): StructureResource
    {
        $this->validatePermission('view');

        return new StructureResource($structure);
    }

    /**
     * Update the specified structure in storage.
     */
    public function update(Structure $structure)
    {
        //
    }

    /**
     * Remove the specified structure from storage.
     */
    public function destroy(Structure $structure)
    {
        //
    }
}
