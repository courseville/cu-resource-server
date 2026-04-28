<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\InterviewPortfolioResource;
use App\Models\Resources\InterviewPortfolio;
use Illuminate\Http\Request;

class InterviewPortfolioController extends ResourceController
{
    protected function modelClass(): string
    {
        return InterviewPortfolio::class;
    }

    protected function resourceClass(): string
    {
        return InterviewPortfolioResource::class;
    }

    /**
     * Display a listing of the interview portfolios.
     *
     * @response AnonymousResourceCollection<InterviewPortfolioResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified interview portfolio.
     *
     * @response InterviewPortfolioResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
