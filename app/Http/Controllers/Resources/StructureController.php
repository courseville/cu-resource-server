<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Resources\StructureResource;
use App\Models\Resources\Structure;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    protected $permissionService;

    public function __construct(
        PermissionService $permissionService,
    ) {
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the structures.
     */
    public function index(Request $request)
    {
        // Check permission
        $client = auth('api')->client();
        $viewableColumns = $this->permissionService->allowedColumns($client, 'view', Structure::class);
        if (empty($viewableColumns)) {
            abort(403, 'No permission to view any columns');
        }

        // Initialize the query builder with viewable columns
        $builder = Structure::query();

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
     * Store a newly created structure in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified structure.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified structure in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified structure from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
