<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\PersonnelSalaryResource;
use App\Models\Resources\PersonnelSalary;
use Illuminate\Http\Request;

class PersonnelSalaryController extends ResourceController
{
    protected function modelClass(): string
    {
        return PersonnelSalary::class;
    }

    protected function resourceClass(): string
    {
        return PersonnelSalaryResource::class;
    }

    /**
     * Display a listing of the personnel salaries.
     *
     * @response AnonymousResourceCollection<PersonnelSalaryResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified personnel salary.
     *
     * @response PersonnelSalaryResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
