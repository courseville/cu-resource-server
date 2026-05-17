<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Resources\Company;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyController extends BaseResourceController
{
    protected string $model = Company::class;

    protected string $resource = CompanyResource::class;

    /**
     * Display a listing of the companies.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        return CompanyResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified company.
     */
    public function show(Company $company): CompanyResource
    {
        $this->validatePermission('view');

        return new CompanyResource($company);
    }
}
