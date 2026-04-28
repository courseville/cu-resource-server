<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\AdmissionApplicationResource;
use App\Models\Resources\AdmissionApplication;
use Illuminate\Http\Request;

class AdmissionApplicationController extends ResourceController
{
    protected function modelClass(): string
    {
        return AdmissionApplication::class;
    }

    protected function resourceClass(): string
    {
        return AdmissionApplicationResource::class;
    }

    /**
     * Display a listing of the admission applications.
     *
     * @response AnonymousResourceCollection<AdmissionApplicationResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified admission application.
     *
     * @response AdmissionApplicationResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
