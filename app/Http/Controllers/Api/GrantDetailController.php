<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\GrantDetailResource;
use App\Models\Resources\GrantDetail;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GrantDetailController extends BaseResourceController
{
    protected string $model = GrantDetail::class;

    protected string $resource = GrantDetailResource::class;

    /**
     * Display a listing of the grantdetail.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        return GrantDetailResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified grant detail.
     */
    public function show(GrantDetail $grantDetail): GrantDetailResource
    {
        $this->validatePermission('view');

        return new GrantDetailResource($grantDetail);
    }
}
