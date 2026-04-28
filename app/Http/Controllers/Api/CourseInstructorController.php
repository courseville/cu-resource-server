<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\CourseInstructorResource;
use App\Models\Resources\CourseInstructor;
use Illuminate\Http\Request;

class CourseInstructorController extends ResourceController
{
    protected function modelClass(): string
    {
        return CourseInstructor::class;
    }

    protected function resourceClass(): string
    {
        return CourseInstructorResource::class;
    }

    /**
     * Display a listing of the course instructors.
     *
     * @response AnonymousResourceCollection<CourseInstructorResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified course instructor.
     *
     * @response CourseInstructorResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
