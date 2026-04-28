<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\FulltimePersonnelResource;
use App\Models\Resources\FulltimePersonnel;
use Illuminate\Http\Request;

class FulltimePersonnelController extends ResourceController
{
    protected function modelClass(): string
    {
        return FulltimePersonnel::class;
    }

    protected function resourceClass(): string
    {
        return FulltimePersonnelResource::class;
    }

    /**
     * Display a listing of the fulltime personnels.
     *
     * @response AnonymousResourceCollection<FulltimePersonnelResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified fulltime personnel.
     *
     * @response FulltimePersonnelResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
