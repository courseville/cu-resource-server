<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\StudentStatusHistoryResource;
use App\Models\Resources\StudentStatusHistory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentStatusHistoryController extends BaseResourceController
{
    protected string $model = StudentStatusHistory::class;

    protected string $resource = StudentStatusHistoryResource::class;

    /**
     * Display a listing of the student status histories.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $viewableColumns = $this->validatePermission('view');
        $builder = StudentStatusHistory::query()->select($viewableColumns);
        $this->applySearch($builder, $request);

        return StudentStatusHistoryResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified student status history.
     */
    public function show(StudentStatusHistory $studentStatusHistory): StudentStatusHistoryResource
    {
        $this->validatePermission('view');

        return new StudentStatusHistoryResource($studentStatusHistory);
    }
}
