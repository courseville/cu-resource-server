<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\StudentGraduationResource;
use App\Models\Resources\StudentGraduation;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentGraduationController extends BaseResourceController
{
    protected string $model = StudentGraduation::class;

    protected string $resource = StudentGraduationResource::class;

    /**
     * Display a listing of the studentgraduation.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        return StudentGraduationResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified student graduation.
     */
    public function show(StudentGraduation $studentGraduation): StudentGraduationResource
    {
        $this->validatePermission('view');

        return new StudentGraduationResource($studentGraduation);
    }
}
