<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\PersonnelSalaryResource;
use App\Models\Resources\PersonnelSalary;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PersonnelSalaryController extends BaseResourceController
{
    protected string $model = PersonnelSalary::class;

    protected string $resource = PersonnelSalaryResource::class;

    /**
     * Display a listing of the personnel salaries.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $viewableColumns = $this->validatePermission('view');
        $builder = PersonnelSalary::query()->select($viewableColumns);
        $this->applySearch($builder, $request);

        return PersonnelSalaryResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified personnel salary.
     */
    public function show(PersonnelSalary $personnelSalary): PersonnelSalaryResource
    {
        $this->validatePermission('view');

        return new PersonnelSalaryResource($personnelSalary);
    }
}
