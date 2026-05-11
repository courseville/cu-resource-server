<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\ContractPersonnelResource;
use App\Models\Resources\ContractPersonnel;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ContractPersonnelController extends BaseResourceController
{
    protected string $model = ContractPersonnel::class;

    protected string $resource = ContractPersonnelResource::class;

    /**
     * Display a listing of the contractpersonnel.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        return ContractPersonnelResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified contract personnel.
     */
    public function show(ContractPersonnel $contractPersonnel): ContractPersonnelResource
    {
        $this->validatePermission('view');

        return new ContractPersonnelResource($contractPersonnel);
    }
}
