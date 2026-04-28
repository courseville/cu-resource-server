<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\GrantDetailResource;
use App\Models\Resources\GrantDetail;
use Illuminate\Http\Request;

class GrantDetailController extends ResourceController
{
    protected function modelClass(): string
    {
        return GrantDetail::class;
    }

    protected function resourceClass(): string
    {
        return GrantDetailResource::class;
    }

    /**
     * Display a listing of the grant details.
     *
     * @response AnonymousResourceCollection<GrantDetailResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified grant detail.
     *
     * @response GrantDetailResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
