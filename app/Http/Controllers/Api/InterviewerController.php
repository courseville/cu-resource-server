<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\InterviewerResource;
use App\Models\Resources\Interviewer;
use Illuminate\Http\Request;

class InterviewerController extends ResourceController
{
    protected function modelClass(): string
    {
        return Interviewer::class;
    }

    protected function resourceClass(): string
    {
        return InterviewerResource::class;
    }

    /**
     * Display a listing of the interviewers.
     *
     * @response AnonymousResourceCollection<InterviewerResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified interviewer.
     *
     * @response InterviewerResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
