<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\StudentResource;
use App\Models\Resources\Student;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentController extends BaseResourceController
{
    protected string $model = Student::class;

    protected string $resource = StudentResource::class;

    /**
     * Display a listing of the students.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        return StudentResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student): StudentResource
    {
        $this->validatePermission('view');

        return new StudentResource($student);
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Student $student)
    {
        //
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
