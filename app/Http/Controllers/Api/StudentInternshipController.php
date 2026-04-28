<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\StudentInternshipResource;
use App\Models\Resources\StudentInternship;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentInternshipController extends BaseResourceController
{
    protected string $model = StudentInternship::class;

    protected string $resource = StudentInternshipResource::class;

    /**
     * Display a listing of the student internships.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $viewableColumns = $this->validatePermission('view');
        $builder = StudentInternship::query()->select($viewableColumns);
        $this->applySearch($builder, $request);

        return StudentInternshipResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified student internship.
     */
    public function show(StudentInternship $studentInternship): StudentInternshipResource
    {
        $this->validatePermission('view');

        return new StudentInternshipResource($studentInternship);
    }
}
