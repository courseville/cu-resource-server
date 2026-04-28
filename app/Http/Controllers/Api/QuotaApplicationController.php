<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\QuotaApplicationResource;
use App\Models\Resources\QuotaApplication;
use Illuminate\Http\Request;

class QuotaApplicationController extends ResourceController
{
    protected function modelClass(): string
    {
        return QuotaApplication::class;
    }

    protected function resourceClass(): string
    {
        return QuotaApplicationResource::class;
    }

    /**
     * Display a listing of the quota applications.
     *
     * @response AnonymousResourceCollection<QuotaApplicationResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified quota application.
     *
     * @response QuotaApplicationResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
