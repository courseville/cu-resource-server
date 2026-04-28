<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\PersonnelCollection;
use App\Http\Resources\PersonnelResource;
use App\Models\Resources\Personnel;
use App\Models\Resources\Structure;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PersonnelController extends ResourceController
{
    protected function modelClass(): string
    {
        return Personnel::class;
    }

    protected function resourceClass(): string
    {
        return PersonnelResource::class;
    }

    /**
     * Display a listing of the personnel.
     *
     * @response PersonnelCollection<LengthAwarePaginator<PersonnelResource>>
     */
    public function index(Request $request)
    {
        // Check permission
        $client = auth('api')->client();
        $permissionService = app(PermissionService::class);
        $viewableColumns = $permissionService->allowedColumns($client, 'view', Personnel::class);
        if (empty($viewableColumns)) {
            abort(403, 'No permission to view any columns');
        }

        // Initialize the query builder with viewable columns
        $builder = Personnel::query();
        $builder->select($viewableColumns);

        // Apply filters if any
        $params = $request->validate([
            'structure_id' => 'string',
        ]);

        if (isset($params['structure_id'])) {
            $structure = Structure::where('structure_id', $params['structure_id'])->first();
            if (is_null($structure)) {
                return PersonnelResource::collection(Personnel::where('id', -1)->paginate(10));
            }
            $builder->whereHas('structureProfiles', function ($query) use ($structure) {
                $query->where(function ($q) use ($structure) {
                    $q->where('structure_level1_id', $structure->id);
                    $q->orWhere('structure_level2_id', $structure->id);
                    $q->orWhere('structure_level3_id', $structure->id);
                    $q->orWhere('structure_level4_id', $structure->id);
                });
            });
        }

        // Search on searchable columns
        $searchableAttributes = (new Personnel)->getSearchable();
        $builder->searchByAttributes(
            $request->string('name', ''),
            ...$searchableAttributes
        );

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

        $request->page = $request->integer('page', 1);
        $data = $builder->paginate($request->integer('n', 10));

        return PersonnelResource::collection($data);
    }

    /**
     * Display the specified personnel.
     *
     * @response PersonnelResource
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

        $personnel = Personnel::select($viewableColumns)->where('personnel_id', $id)->firstOrFail();

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
}
