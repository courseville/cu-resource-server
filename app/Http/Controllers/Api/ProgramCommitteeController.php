<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\ProgramCommitteeResource;
use App\Models\Resources\ProgramCommittee;
use Illuminate\Http\Request;

class ProgramCommitteeController extends ResourceController
{
    protected function modelClass(): string
    {
        return ProgramCommittee::class;
    }

    protected function resourceClass(): string
    {
        return ProgramCommitteeResource::class;
    }

    /**
     * Display a listing of the program committees.
     *
     * @response AnonymousResourceCollection<ProgramCommitteeResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified program committee.
     *
     * @response ProgramCommitteeResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
