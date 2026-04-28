<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\PortfolioResource;
use App\Models\Resources\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends ResourceController
{
    protected function modelClass(): string
    {
        return Portfolio::class;
    }

    protected function resourceClass(): string
    {
        return PortfolioResource::class;
    }

    /**
     * Display a listing of the portfolios.
     *
     * @response AnonymousResourceCollection<PortfolioResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified portfolio.
     *
     * @response PortfolioResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
