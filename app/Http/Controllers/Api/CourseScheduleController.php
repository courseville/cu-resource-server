<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\CourseScheduleResource;
use App\Models\Resources\CourseSchedule;
use Illuminate\Http\Request;

class CourseScheduleController extends ResourceController
{
    protected function modelClass(): string
    {
        return CourseSchedule::class;
    }

    protected function resourceClass(): string
    {
        return CourseScheduleResource::class;
    }

    /**
     * Display a listing of the course schedules.
     *
     * @response AnonymousResourceCollection<CourseScheduleResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified course schedule.
     *
     * @response CourseScheduleResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
