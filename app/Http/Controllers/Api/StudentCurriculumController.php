<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\StudentCurriculumResource;
use App\Models\Resources\StudentCurriculum;
use Illuminate\Http\Request;

class StudentCurriculumController extends ResourceController
{
    protected function modelClass(): string
    {
        return StudentCurriculum::class;
    }

    protected function resourceClass(): string
    {
        return StudentCurriculumResource::class;
    }

    /**
     * Display a listing of student curriculums.
     *
     * @response AnonymousResourceCollection<StudentCurriculumResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified student curriculum.
     *
     * @response StudentCurriculumResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
