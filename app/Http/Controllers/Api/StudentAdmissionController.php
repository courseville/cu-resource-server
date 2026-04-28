<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\StudentAdmissionResource;
use App\Models\Resources\StudentAdmission;
use Illuminate\Http\Request;

class StudentAdmissionController extends ResourceController
{
    protected function modelClass(): string
    {
        return StudentAdmission::class;
    }

    protected function resourceClass(): string
    {
        return StudentAdmissionResource::class;
    }

    /**
     * Display a listing of the student admissions.
     *
     * @response AnonymousResourceCollection<StudentAdmissionResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified student admission.
     *
     * @response StudentAdmissionResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
