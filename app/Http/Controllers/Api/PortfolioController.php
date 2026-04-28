<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BaseResourceRequest;
use App\Http\Resources\PortfolioResource;
use App\Models\Resources\Portfolio;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PortfolioController extends BaseResourceController
{
    protected string $model = Portfolio::class;

    protected string $resource = PortfolioResource::class;

    /**
     * Display a listing of the portfolios.
     */
    public function index(BaseResourceRequest $request): AnonymousResourceCollection
    {
        $viewableColumns = $this->validatePermission('view');
        $builder = Portfolio::query()->select($viewableColumns);
        $this->applySearch($builder, $request);

        return PortfolioResource::collection($builder->paginate($request->integer('n', 10)));
    }

    /**
     * Display the specified portfolio.
     */
    public function show(Portfolio $portfolio): PortfolioResource
    {
        $this->validatePermission('view');

        return new PortfolioResource($portfolio);
    }
}
