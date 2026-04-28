<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\ProgramCommitteeResource;
use App\Models\Resources\ProgramCommittee;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProgramCommitteeController extends BaseResourceController
{
    protected string $model = ProgramCommittee::class;

    protected string $resource = ProgramCommitteeResource::class;

    /**
     * Display a listing of the program committees.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $viewableColumns = $this->validatePermission('view');
        $builder = ProgramCommittee::query()->select($viewableColumns);
        $this->applySearch($builder, $request);

        return ProgramCommitteeResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified program committee.
     */
    public function show(ProgramCommittee $programCommittee): ProgramCommitteeResource
    {
        $this->validatePermission('view');

        return new ProgramCommitteeResource($programCommittee);
    }
}
