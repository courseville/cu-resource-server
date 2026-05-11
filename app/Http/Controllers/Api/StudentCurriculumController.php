<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\StudentCurriculumResource;
use App\Models\Resources\StudentCurriculum;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentCurriculumController extends BaseResourceController
{
    protected string $model = StudentCurriculum::class;

    protected string $resource = StudentCurriculumResource::class;

    /**
     * Display a listing of the studentcurriculum.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        return StudentCurriculumResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified student curriculum.
     */
    public function show(StudentCurriculum $studentCurriculum): StudentCurriculumResource
    {
        $this->validatePermission('view');

        return new StudentCurriculumResource($studentCurriculum);
    }
}
