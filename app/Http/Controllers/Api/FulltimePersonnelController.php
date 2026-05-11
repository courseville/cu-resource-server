<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\FulltimePersonnelResource;
use App\Models\Resources\FulltimePersonnel;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FulltimePersonnelController extends BaseResourceController
{
    protected string $model = FulltimePersonnel::class;

    protected string $resource = FulltimePersonnelResource::class;

    /**
     * Display a listing of the fulltimepersonnel.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        return FulltimePersonnelResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified fulltime personnel.
     */
    public function show(FulltimePersonnel $fulltimePersonnel): FulltimePersonnelResource
    {
        $this->validatePermission('view');

        return new FulltimePersonnelResource($fulltimePersonnel);
    }
}
