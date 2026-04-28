<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\StudentAdmissionResource;
use App\Models\Resources\StudentAdmission;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentAdmissionController extends BaseResourceController
{
    protected string $model = StudentAdmission::class;

    protected string $resource = StudentAdmissionResource::class;

    /**
     * Display a listing of the student admissions.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $viewableColumns = $this->validatePermission('view');
        $builder = StudentAdmission::query()->select($viewableColumns);
        $this->applySearch($builder, $request);

        return StudentAdmissionResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified student admission.
     */
    public function show(StudentAdmission $studentAdmission): StudentAdmissionResource
    {
        $this->validatePermission('view');

        return new StudentAdmissionResource($studentAdmission);
    }
}
