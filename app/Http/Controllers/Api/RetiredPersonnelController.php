<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\RetiredPersonnelResource;
use App\Models\Resources\RetiredPersonnel;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RetiredPersonnelController extends BaseResourceController
{
    protected string $model = RetiredPersonnel::class;

    protected string $resource = RetiredPersonnelResource::class;

    /**
     * Display a listing of the retiredpersonnel.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        return RetiredPersonnelResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified retired personnel.
     */
    public function show(RetiredPersonnel $retiredPersonnel): RetiredPersonnelResource
    {
        $this->validatePermission('view');

        return new RetiredPersonnelResource($retiredPersonnel);
    }
}
