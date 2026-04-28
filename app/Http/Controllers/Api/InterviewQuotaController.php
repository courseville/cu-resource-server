<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\InterviewQuotaResource;
use App\Models\Resources\InterviewQuota;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InterviewQuotaController extends BaseResourceController
{
    protected string $model = InterviewQuota::class;

    protected string $resource = InterviewQuotaResource::class;

    /**
     * Display a listing of the interview quotas.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $viewableColumns = $this->validatePermission('view');
        $builder = InterviewQuota::query()->select($viewableColumns);
        $this->applySearch($builder, $request);

        return InterviewQuotaResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified interview quota.
     */
    public function show(InterviewQuota $interviewQuota): InterviewQuotaResource
    {
        $this->validatePermission('view');

        return new InterviewQuotaResource($interviewQuota);
    }
}
