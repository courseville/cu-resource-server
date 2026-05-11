<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\AdmissionApplicationResource;
use App\Models\Resources\AdmissionApplication;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdmissionApplicationController extends BaseResourceController
{
    protected string $model = AdmissionApplication::class;

    protected string $resource = AdmissionApplicationResource::class;

    /**
     * Display a listing of the admissionapplication.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        return AdmissionApplicationResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified admission application.
     */
    public function show(AdmissionApplication $admissionApplication): AdmissionApplicationResource
    {
        $this->validatePermission('view');

        return new AdmissionApplicationResource($admissionApplication);
    }
}
