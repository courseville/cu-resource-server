<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\StudentApplicationResource;
use App\Models\Resources\StudentApplication;
use Illuminate\Http\Request;

class StudentApplicationController extends ResourceController
{
    protected function modelClass(): string
    {
        return StudentApplication::class;
    }

    protected function resourceClass(): string
    {
        return StudentApplicationResource::class;
    }

    /**
     * Display a listing of the student applications.
     *
     * @response AnonymousResourceCollection<StudentApplicationResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified student application.
     *
     * @response StudentApplicationResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
