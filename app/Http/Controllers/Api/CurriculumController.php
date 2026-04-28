<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResourceController;
use App\Http\Resources\CurriculumResource;
use App\Models\Resources\Curriculum;
use Illuminate\Http\Request;

class CurriculumController extends ResourceController
{
    protected function modelClass(): string
    {
        return Curriculum::class;
    }

    protected function resourceClass(): string
    {
        return CurriculumResource::class;
    }

    /**
     * Display a listing of the curriculums.
     *
     * @response AnonymousResourceCollection<CurriculumResource>
     */
    public function index(Request $request)
    {
        return parent::index($request);
    }

    /**
     * Display the specified curriculum.
     *
     * @response CurriculumResource
     */
    public function show(string $id)
    {
        return parent::show($id);
    }
}
