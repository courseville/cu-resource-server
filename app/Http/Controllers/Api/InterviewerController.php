<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\InterviewerResource;
use App\Models\Resources\Interviewer;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InterviewerController extends BaseResourceController
{
    protected string $model = Interviewer::class;

    protected string $resource = InterviewerResource::class;

    /**
     * Display a listing of the interviewer.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $builder = $this->getBuilder($request);

        return InterviewerResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified interviewer.
     */
    public function show(Interviewer $interviewer): InterviewerResource
    {
        $this->validatePermission('view');

        return new InterviewerResource($interviewer);
    }
}
