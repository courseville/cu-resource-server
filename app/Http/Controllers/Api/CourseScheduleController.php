<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\CourseScheduleResource;
use App\Models\Resources\CourseSchedule;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CourseScheduleController extends BaseResourceController
{
    protected string $model = CourseSchedule::class;

    protected string $resource = CourseScheduleResource::class;

    /**
     * Display a listing of the courseschedule.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        return CourseScheduleResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified course schedule.
     */
    public function show(CourseSchedule $courseSchedule): CourseScheduleResource
    {
        $this->validatePermission('view');

        return new CourseScheduleResource($courseSchedule);
    }
}
