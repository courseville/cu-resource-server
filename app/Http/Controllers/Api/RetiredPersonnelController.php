<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\RetiredPersonnelResource;
use App\Models\Resources\RetiredPersonnel;
use Illuminate\Http\Request;

class RetiredPersonnelController extends ResourceController
{
    protected function modelClass(): string
    {
        return RetiredPersonnel::class;
    }

    protected function resourceClass(): string
    {
        return RetiredPersonnelResource::class;
    }

    /**
     * Display a listing of the retired personnels.
     *
     * @response AnonymousResourceCollection<RetiredPersonnelResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified retired personnel.
     *
     * @response RetiredPersonnelResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
