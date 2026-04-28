<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\StudentApplicationResource;
use App\Models\Resources\StudentApplication;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentApplicationController extends BaseResourceController
{
    protected string $model = StudentApplication::class;

    protected string $resource = StudentApplicationResource::class;

    /**
     * Display a listing of the student applications.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $viewableColumns = $this->validatePermission('view');
        $builder = StudentApplication::query()->select($viewableColumns);
        $this->applySearch($builder, $request);

        return StudentApplicationResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified student application.
     */
    public function show(StudentApplication $studentApplication): StudentApplicationResource
    {
        $this->validatePermission('view');

        return new StudentApplicationResource($studentApplication);
    }
}
