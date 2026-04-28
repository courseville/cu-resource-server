<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\StudentGraduationResource;
use App\Models\Resources\StudentGraduation;
use Illuminate\Http\Request;

class StudentGraduationController extends ResourceController
{
    protected function modelClass(): string
    {
        return StudentGraduation::class;
    }

    protected function resourceClass(): string
    {
        return StudentGraduationResource::class;
    }

    /**
     * Display a listing of the student graduations.
     *
     * @response AnonymousResourceCollection<StudentGraduationResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified student graduation.
     *
     * @response StudentGraduationResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
