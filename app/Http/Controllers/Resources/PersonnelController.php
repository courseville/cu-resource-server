<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonnelCollection;
use App\Http\Resources\PersonnelResource;
use App\Models\Resources\Personnel;
use App\Models\Resources\Structure;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PersonnelController extends Controller
{
    protected $permissionService;

    public function __construct(
        PermissionService $permissionService,
    ) {
        $this->permissionService = $permissionService;
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
        $viewableColumns = $this->permissionService->allowedColumns($client, 'view', Personnel::class);
        if (empty($viewableColumns)) {
            abort(403, 'No permission to view any columns');
        }

        // Initialize the query builder with viewable columns
        $builder = Personnel::query();

        // Apply filters if any
        $params = $request->validate([
            'structure_id' => 'string',
        ]);

        if (isset($params['structure_id'])) {
            $structure = Structure::where('structure_id', $params['structure_id'])->first();
            if (is_null($structure)) {
                return response()->json(Personnel::where('id', -1)->paginate(10));
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
     * Store a newly created personnel in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified personnel.
     */
    public function show(Personnel $personnel)
    {
        // $personnel->load([
        //     // relationships
        //     'structureProfiles' => function ($query) {
        //         // columns
        //         $query->select('id', 'structure_level1_id', 'structure_level2_id', 'structure_level3_id', 'structure_level4_id', 'personnel_id')->with([
        //             // relationships and columns
        //             'structureLevel1:id,name',
        //             'structureLevel2:id,name',
        //             'structureLevel3:id,name',
        //             'structureLevel4:id,name',
        //         ]);
        //     },
        // ]);

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

        return response()->json(PersonnelResource::make($personnel));
    }

    /**
     * Update the specified personnel in storage.
     */
    public function update(Request $request, Personnel $personnel)
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
