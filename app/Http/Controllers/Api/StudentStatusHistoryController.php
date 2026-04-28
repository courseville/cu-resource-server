<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\StudentStatusHistoryResource;
use App\Models\Resources\StudentStatusHistory;
use Illuminate\Http\Request;

class StudentStatusHistoryController extends ResourceController
{
    protected function modelClass(): string
    {
        return StudentStatusHistory::class;
    }

    protected function resourceClass(): string
    {
        return StudentStatusHistoryResource::class;
    }

    /**
     * Display a listing of the student status histories.
     *
     * @response AnonymousResourceCollection<StudentStatusHistoryResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified student status history.
     *
     * @response StudentStatusHistoryResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
