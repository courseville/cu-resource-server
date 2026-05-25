<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\CourseResource;
use App\Models\Resources\Course;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CourseController extends BaseResourceController
{
    protected string $model = Course::class;

    protected string $resource = CourseResource::class;

    /**
     * Display a listing of the courses.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        return CourseResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course): CourseResource
    {
        $this->validatePermission('view');

        return new CourseResource($course);
    }
}
