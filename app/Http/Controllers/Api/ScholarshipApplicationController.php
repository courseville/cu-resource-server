<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\ScholarshipApplicationResource;
use App\Models\Resources\ScholarshipApplication;
use Illuminate\Http\Request;

class ScholarshipApplicationController extends ResourceController
{
    protected function modelClass(): string
    {
        return ScholarshipApplication::class;
    }

    protected function resourceClass(): string
    {
        return ScholarshipApplicationResource::class;
    }

    /**
     * Display a listing of the scholarship applications.
     *
     * @response AnonymousResourceCollection<ScholarshipApplicationResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified scholarship application.
     *
     * @response ScholarshipApplicationResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
