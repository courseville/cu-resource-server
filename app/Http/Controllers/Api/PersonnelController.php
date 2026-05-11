<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Requests\Api\Personnel\IndexPersonnelRequest;
use App\Http\Resources\PersonnelResource;
use App\Models\Resources\Personnel;
use App\Models\Resources\Structure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PersonnelController extends BaseResourceController
{
    protected string $model = Personnel::class;

    protected string $resource = PersonnelResource::class;

    /**
     * Get the query builder for the personnel.
     */
    protected function getBuilder(BaseResourceRequest $request): Builder
    {
        $viewableColumns = $this->validatePermission('view');

        // Initialize the query builder with viewable columns
        $builder = Personnel::query()->select($viewableColumns);

        if ($request->filled('structure_id')) {
            $structure = Structure::where('structure_id', $request->structure_id)->first();
            if (is_null($structure)) {
                $builder->where('id', -1);
            } else {
                $builder->whereHas('structureProfiles', function ($query) use ($structure) {
                    $query->where(function ($q) use ($structure) {
                        $q->where('structure_level1_id', $structure->id);
                        $q->orWhere('structure_level2_id', $structure->id);
                        $q->orWhere('structure_level3_id', $structure->id);
                        $q->orWhere('structure_level4_id', $structure->id);
                    });
                });
            }
        }

        // Search on searchable columns
        $this->applySearch($builder, $request);

        return $builder;
    }

    /**
     * Display a listing of the personnel.
     */
    public function index(IndexPersonnelRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        // With relationships
        $builder->with([
            'structureProfiles' => function ($query) {
                $query->with([
                    'structureLevel1',
                    'structureLevel2',
                    'structureLevel3',
                    'structureLevel4',
                ]);
            },
        ]);

        return PersonnelResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Store a newly created personnel in storage.
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified personnel.
     */
    public function show(Personnel $personnel): PersonnelResource
    {
        $this->validatePermission('view');

        $personnel->load([
            'structureProfiles' => function ($query) {
                $query->with([
                    'structureLevel1',
                    'structureLevel2',
                    'structureLevel3',
                    'structureLevel4',
                ]);
            },
        ]);

        return new PersonnelResource($personnel);
    }

    /**
     * Update the specified personnel in storage.
     */
    public function update(Personnel $personnel)
    {
        //
    }

    /**
     * Remove the specified personnel from storage.
     */
    public function destroy(Personnel $personnel)
    {
        //
    }
}
