<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resources\StudentCurriculum;
use Illuminate\Http\Request;

class StudentCurriculumController extends Controller
{
    /**
     * Display a listing of student curriculums.
     */
    public function index(Request $request)
    {
        // Global scope 'DataDomainScope' is automatically applied via 'HasDomainScope' trait
        return StudentCurriculum::paginate();
    }

    /**
     * Display the specified student curriculum.
     */
    public function show(StudentCurriculum $studentCurriculum)
    {
        return $studentCurriculum;
    }
}
