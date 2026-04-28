<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\ScholarshipApplicationResource;
use App\Models\Resources\ScholarshipApplication;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ScholarshipApplicationController extends BaseResourceController
{
    protected string $model = ScholarshipApplication::class;

    protected string $resource = ScholarshipApplicationResource::class;

    /**
     * Display a listing of the scholarship applications.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $viewableColumns = $this->validatePermission('view');
        $builder = ScholarshipApplication::query()->select($viewableColumns);
        $this->applySearch($builder, $request);

        return ScholarshipApplicationResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified scholarship application.
     */
    public function show(ScholarshipApplication $scholarshipApplication): ScholarshipApplicationResource
    {
        $this->validatePermission('view');

        return new ScholarshipApplicationResource($scholarshipApplication);
    }
}
