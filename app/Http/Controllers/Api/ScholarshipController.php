<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\ScholarshipResource;
use App\Models\Resources\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends ResourceController
{
    protected function modelClass(): string
    {
        return Scholarship::class;
    }

    protected function resourceClass(): string
    {
        return ScholarshipResource::class;
    }

    /**
     * Display a listing of the scholarships.
     *
     * @response AnonymousResourceCollection<ScholarshipResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified scholarship.
     *
     * @response ScholarshipResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
