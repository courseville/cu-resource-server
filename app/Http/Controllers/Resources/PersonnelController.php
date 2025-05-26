<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Resources\Personnel;
use App\Models\Resources\Structure;
use App\Services\PermissionService;
use App\Traits\Paginatable;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class PersonnelController extends Controller
{
    use Paginatable, Searchable;

    protected $modelClass;

    protected $permissionService;

    public function __construct(
        PermissionService $permissionService,
    ) {
        $this->modelClass = Personnel::class;
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

        // Apply filters if any
        $params = $request->validate([
            'structure_id' => 'string',
        ]);
        if (isset($params['structure_id'])) {
            $structure = Structure::where('structure_id', $params['structure_id'])->first();
            if (is_null($structure)) {
                return response()->json($this->modelClass::where('id', -1)->paginate(10));
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
    public function show(Personnel $personnel)
    {
        $personnel->makeHidden([
            'created_at',
            'updated_at',
        ]);
        $personnel->load([
            // relationships
            'structureProfiles' => function ($query) {
                // columns
                $query->select('id', 'structure_level1_id', 'structure_level2_id', 'structure_level3_id', 'structure_level4_id', 'personnel_id')->with([
                    // relationships and columns
                    'structureLevel1:id,name',
                    'structureLevel2:id,name',
                    'structureLevel3:id,name',
                    'structureLevel4:id,name',
                ]);
            },
        ]);
        return response()->json($personnel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Personnel $personnel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personnel $personnel)
    {
        //
    }
}
