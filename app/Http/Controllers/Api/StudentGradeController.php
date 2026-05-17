<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\StudentGradeResource;
use App\Models\Resources\StudentGrade;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentGradeController extends BaseResourceController
{
    protected string $model = StudentGrade::class;

    protected string $resource = StudentGradeResource::class;

    /**
     * Display a listing of the student grades.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        return StudentGradeResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified student grade.
     */
    public function show(StudentGrade $studentGrade): StudentGradeResource
    {
        $this->validatePermission('view');

        return new StudentGradeResource($studentGrade);
    }
}
