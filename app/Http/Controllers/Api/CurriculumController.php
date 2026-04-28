<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\CurriculumResource;
use App\Models\Resources\Curriculum;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CurriculumController extends BaseResourceController
{
    protected string $model = Curriculum::class;

    protected string $resource = CurriculumResource::class;

    /**
     * Display a listing of the curriculums.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $viewableColumns = $this->validatePermission('view');
        $builder = Curriculum::query()->select($viewableColumns);
        $this->applySearch($builder, $request);

        return CurriculumResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified curriculum.
     */
    public function show(Curriculum $curriculum): CurriculumResource
    {
        $this->validatePermission('view');

        return new CurriculumResource($curriculum);
    }
}
