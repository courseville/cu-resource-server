<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\InterviewPortfolioResource;
use App\Models\Resources\InterviewPortfolio;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InterviewPortfolioController extends BaseResourceController
{
    protected string $model = InterviewPortfolio::class;

    protected string $resource = InterviewPortfolioResource::class;

    /**
     * Display a listing of the interview portfolios.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $viewableColumns = $this->validatePermission('view');
        $builder = InterviewPortfolio::query()->select($viewableColumns);
        $this->applySearch($builder, $request);

        return InterviewPortfolioResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified interview portfolio.
     */
    public function show(InterviewPortfolio $interviewPortfolio): InterviewPortfolioResource
    {
        $this->validatePermission('view');

        return new InterviewPortfolioResource($interviewPortfolio);
    }
}
