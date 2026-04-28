<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\InterviewQuotaResource;
use App\Models\Resources\InterviewQuota;
use Illuminate\Http\Request;

class InterviewQuotaController extends ResourceController
{
    protected function modelClass(): string
    {
        return InterviewQuota::class;
    }

    protected function resourceClass(): string
    {
        return InterviewQuotaResource::class;
    }

    /**
     * Display a listing of the interview quotas.
     *
     * @response AnonymousResourceCollection<InterviewQuotaResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified interview quota.
     *
     * @response InterviewQuotaResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
