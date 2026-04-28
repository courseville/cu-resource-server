<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\AcademicProgramResource;
use App\Models\Resources\AcademicProgram;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AcademicProgramController extends BaseResourceController
{
    protected string $model = AcademicProgram::class;

    protected string $resource = AcademicProgramResource::class;

    /**
     * Display a listing of the academic programs.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $viewableColumns = $this->validatePermission('view');
        $builder = AcademicProgram::query()->select($viewableColumns);
        $this->applySearch($builder, $request);

        return AcademicProgramResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified academic program.
     */
    public function show(AcademicProgram $academicProgram): AcademicProgramResource
    {
        $this->validatePermission('view');

        return new AcademicProgramResource($academicProgram);
    }
}
