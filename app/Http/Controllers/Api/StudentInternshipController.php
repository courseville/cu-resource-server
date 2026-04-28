<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\StudentInternshipResource;
use App\Models\Resources\StudentInternship;
use Illuminate\Http\Request;

class StudentInternshipController extends ResourceController
{
    protected function modelClass(): string
    {
        return StudentInternship::class;
    }

    protected function resourceClass(): string
    {
        return StudentInternshipResource::class;
    }

    /**
     * Display a listing of the student internships.
     *
     * @response AnonymousResourceCollection<StudentInternshipResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified student internship.
     *
     * @response StudentInternshipResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
