<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\QuotaApplicationResource;
use App\Models\Resources\QuotaApplication;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class QuotaApplicationController extends BaseResourceController
{
    protected string $model = QuotaApplication::class;

    protected string $resource = QuotaApplicationResource::class;

    /**
     * Display a listing of the quotaapplication.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        return QuotaApplicationResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified quota application.
     */
    public function show(QuotaApplication $quotaApplication): QuotaApplicationResource
    {
        $this->validatePermission('view');

        return new QuotaApplicationResource($quotaApplication);
    }
}
