<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\ScholarshipResource;
use App\Models\Resources\Scholarship;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ScholarshipController extends BaseResourceController
{
    protected string $model = Scholarship::class;

    protected string $resource = ScholarshipResource::class;

    /**
     * Display a listing of the scholarships.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $viewableColumns = $this->validatePermission('view');
        $builder = Scholarship::query()->select($viewableColumns);
        $this->applySearch($builder, $request);

        return ScholarshipResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified scholarship.
     */
    public function show(Scholarship $scholarship): ScholarshipResource
    {
        $this->validatePermission('view');

        return new ScholarshipResource($scholarship);
    }
}
