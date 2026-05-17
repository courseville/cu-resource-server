<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\StudentAdvisorResource;
use App\Models\Resources\StudentAdvisor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentAdvisorController extends BaseResourceController
{
    protected string $model = StudentAdvisor::class;

    protected string $resource = StudentAdvisorResource::class;

    /**
     * Display a listing of the student advisors.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        return StudentAdvisorResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified student advisor.
     */
    public function show(StudentAdvisor $studentAdvisor): StudentAdvisorResource
    {
        $this->validatePermission('view');

        return new StudentAdvisorResource($studentAdvisor);
    }
}
