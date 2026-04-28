<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\StructureProfileResource;
use App\Models\Resources\StructureProfile;
use Illuminate\Http\Request;

class StructureProfileController extends ResourceController
{
    protected function modelClass(): string
    {
        return StructureProfile::class;
    }

    protected function resourceClass(): string
    {
        return StructureProfileResource::class;
    }

    /**
     * Display a listing of the structure profiles.
     *
     * @response AnonymousResourceCollection<StructureProfileResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified structure profile.
     *
     * @response StructureProfileResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
