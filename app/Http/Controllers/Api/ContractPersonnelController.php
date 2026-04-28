<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\ContractPersonnelResource;
use App\Models\Resources\ContractPersonnel;
use Illuminate\Http\Request;

class ContractPersonnelController extends ResourceController
{
    protected function modelClass(): string
    {
        return ContractPersonnel::class;
    }

    protected function resourceClass(): string
    {
        return ContractPersonnelResource::class;
    }

    /**
     * Display a listing of the contract personnels.
     *
     * @response AnonymousResourceCollection<ContractPersonnelResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified contract personnel.
     *
     * @response ContractPersonnelResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
