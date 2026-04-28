<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\StructureProfileResource;
use App\Models\Resources\StructureProfile;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StructureProfileController extends BaseResourceController
{
    protected string $model = StructureProfile::class;

    protected string $resource = StructureProfileResource::class;

    /**
     * Display a listing of the structure profiles.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $viewableColumns = $this->validatePermission('view');
        $builder = StructureProfile::query()->select($viewableColumns);
        $this->applySearch($builder, $request);

        return StructureProfileResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified structure profile.
     */
    public function show(StructureProfile $structureProfile): StructureProfileResource
    {
        $this->validatePermission('view');

        return new StructureProfileResource($structureProfile);
    }
}
