<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\CourseInstructorResource;
use App\Models\Resources\CourseInstructor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CourseInstructorController extends BaseResourceController
{
    protected string $model = CourseInstructor::class;

    protected string $resource = CourseInstructorResource::class;

    /**
     * Display a listing of the courseinstructor.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        return CourseInstructorResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified course instructor.
     */
    public function show(CourseInstructor $courseInstructor): CourseInstructorResource
    {
        $this->validatePermission('view');

        return new CourseInstructorResource($courseInstructor);
    }
}
