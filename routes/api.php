<?php

use App\Http\Controllers\Api\AcademicProgramController;
use App\Http\Controllers\Api\AdmissionApplicationController;
use App\Http\Controllers\Api\ContractPersonnelController;
use App\Http\Controllers\Api\CourseInstructorController;
use App\Http\Controllers\Api\CourseScheduleController;
use App\Http\Controllers\Api\CurriculumController;
use App\Http\Controllers\Api\FulltimePersonnelController;
use App\Http\Controllers\Api\GrantDetailController;
use App\Http\Controllers\Api\InterviewerController;
use App\Http\Controllers\Api\InterviewPortfolioController;
use App\Http\Controllers\Api\InterviewQuotaController;
use App\Http\Controllers\Api\PersonnelController;
use App\Http\Controllers\Api\PersonnelSalaryController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\ProgramCommitteeController;
use App\Http\Controllers\Api\QuotaApplicationController;
use App\Http\Controllers\Api\RetiredPersonnelController;
use App\Http\Controllers\Api\ScholarshipApplicationController;
use App\Http\Controllers\Api\ScholarshipController;
use App\Http\Controllers\Api\StructureController;
use App\Http\Controllers\Api\StructureProfileController;
use App\Http\Controllers\Api\StudentAdmissionController;
use App\Http\Controllers\Api\StudentApplicationController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\StudentCurriculumController;
use App\Http\Controllers\Api\StudentGraduationController;
use App\Http\Controllers\Api\StudentInternshipController;
use App\Http\Controllers\Api\StudentStatusHistoryController;
// use App\Models\DataSource;
use App\Models\User;
// use App\Services\PermissionService;
// use App\Transformers\DataTransformer;
// use Filament\Resources\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/users', function (Request $request) {
    return User::get();
})->middleware(['auth:api', 'scopes:admin,student']);

Route::get('/test-mock', function (Request $request) {
    return Client::get();
})->middleware('auth:api');

Route::get('/user-withscope', function (Request $request) {
    return $request->user();
})->middleware(['auth:api', 'scope:student']);

Route::get('/scopes-nomid', function (Request $request) {
    $scopes = Passport::scopes();

    return response()->json($scopes);
});

// Route for internal API access
Route::middleware(['auth:api'])->prefix('internal')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('permission:view|App\Models\User');
});

// Route for client oauth code access
Route::middleware(['auth:api', 'scopes:user.read'])->prefix('external')->group(function () {
    Route::get('/user', function (Request $request) {
        $user = $request->user();
        $viewableColumns = $request->get('viewableColumns');
        $userData = User::select($viewableColumns)->where('id', $user->id)->first();

        return $userData;
    })->middleware('permission:view|App\Models\User');
});

// Route for client no user data access
Route::middleware('client:general.read,machine')->group(function () {
    Route::get('/scopes', function (Request $request) {
        $scopes = Passport::scopes();

        return response()->json($scopes);
    });
});

// Route for client user data access
Route::middleware(['client:admin.read', 'permission:view|App\Models\User'])->prefix('client')->group(function () {
    Route::get('/users', function (Request $request) {
        $viewableColumns = $request->get('viewableColumns');
        $userData = User::select($viewableColumns)->get();

        return $userData;
    });
});

// Route::middleware('auth:api')->get('/resource/{entity}', function (Request $request, $entity) {
//     // Check if the table exists
//     if (!Schema::hasTable($entity)) {
//         abort(404, "Table not found");
//     }

//     $modelClass = 'App\\Models\\Resources\\' . Str::studly(Str::singular($entity));

//     if (!class_exists($modelClass)) {
//         abort(404, "Model not found");
//     }

//     // Check permission
//     $permissionService = app(PermissionService::class);
//     $viewableColumns = $permissionService->allowedColumns($request->user(), 'view', $modelClass);
//     if (empty($viewableColumns)) {
//         abort(403, "No permission to view any columns");
//     }

//     $data = $modelClass::select($viewableColumns)->get();

//     return response()->json($data);
// });

Route::prefix('v1')->middleware('clients')->group(function () {
    Route::get('/personnel', [PersonnelController::class, 'index'])->name('personnel.index');
    Route::get('/personnel/{personnel:personnel_id}', [PersonnelController::class, 'show'])->name('personnel.show');
    Route::get('/structures', [StructureController::class, 'index'])->name('structures.index');
    Route::get('/structures/{structure:structure_id}', [StructureController::class, 'show'])->name('structures.show');

    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/export', [StudentController::class, 'export'])->name('students.export');
    Route::get('/students/{student:student_code}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/student-curriculums', [StudentCurriculumController::class, 'index'])->name('student-curriculums.index');
    Route::get('/student-curriculums/{studentCurriculum}', [StudentCurriculumController::class, 'show'])->name('student-curriculums.show');

    // Resource Endpoints
    Route::get('/academic-programs', [AcademicProgramController::class, 'index'])->name('academic-programs.index');
    Route::get('/academic-programs/{academic_program}', [AcademicProgramController::class, 'show'])->name('academic-programs.show');
    Route::get('/admission-applications', [AdmissionApplicationController::class, 'index'])->name('admission-applications.index');
    Route::get('/admission-applications/{admission_application}', [AdmissionApplicationController::class, 'show'])->name('admission-applications.show');
    Route::get('/contract-personnels', [ContractPersonnelController::class, 'index'])->name('contract-personnels.index');
    Route::get('/contract-personnels/{contract_personnel}', [ContractPersonnelController::class, 'show'])->name('contract-personnels.show');
    Route::get('/course-instructors', [CourseInstructorController::class, 'index'])->name('course-instructors.index');
    Route::get('/course-instructors/{course_instructor}', [CourseInstructorController::class, 'show'])->name('course-instructors.show');
    Route::get('/course-schedules', [CourseScheduleController::class, 'index'])->name('course-schedules.index');
    Route::get('/course-schedules/{course_schedule}', [CourseScheduleController::class, 'show'])->name('course-schedules.show');
    Route::get('/curriculums', [CurriculumController::class, 'index'])->name('curriculums.index');
    Route::get('/curriculums/{curriculum}', [CurriculumController::class, 'show'])->name('curriculums.show');
    Route::get('/fulltime-personnels', [FulltimePersonnelController::class, 'index'])->name('fulltime-personnels.index');
    Route::get('/fulltime-personnels/{fulltime_personnel}', [FulltimePersonnelController::class, 'show'])->name('fulltime-personnels.show');
    Route::get('/grant-details', [GrantDetailController::class, 'index'])->name('grant-details.index');
    Route::get('/grant-details/{grant_detail}', [GrantDetailController::class, 'show'])->name('grant-details.show');
    Route::get('/interview-portfolios', [InterviewPortfolioController::class, 'index'])->name('interview-portfolios.index');
    Route::get('/interview-portfolios/{interview_portfolio}', [InterviewPortfolioController::class, 'show'])->name('interview-portfolios.show');
    Route::get('/interview-quotas', [InterviewQuotaController::class, 'index'])->name('interview-quotas.index');
    Route::get('/interview-quotas/{interview_quota}', [InterviewQuotaController::class, 'show'])->name('interview-quotas.show');
    Route::get('/interviewers', [InterviewerController::class, 'index'])->name('interviewers.index');
    Route::get('/interviewers/{interviewer}', [InterviewerController::class, 'show'])->name('interviewers.show');
    Route::get('/personnel-salaries', [PersonnelSalaryController::class, 'index'])->name('personnel-salaries.index');
    Route::get('/personnel-salaries/{personnel_salary}', [PersonnelSalaryController::class, 'show'])->name('personnel-salaries.show');
    Route::get('/portfolios', [PortfolioController::class, 'index'])->name('portfolios.index');
    Route::get('/portfolios/{portfolio}', [PortfolioController::class, 'show'])->name('portfolios.show');
    Route::get('/program-committees', [ProgramCommitteeController::class, 'index'])->name('program-committees.index');
    Route::get('/program-committees/{program_committee}', [ProgramCommitteeController::class, 'show'])->name('program-committees.show');
    Route::get('/quota-applications', [QuotaApplicationController::class, 'index'])->name('quota-applications.index');
    Route::get('/quota-applications/{quota_application}', [QuotaApplicationController::class, 'show'])->name('quota-applications.show');
    Route::get('/retired-personnels', [RetiredPersonnelController::class, 'index'])->name('retired-personnels.index');
    Route::get('/retired-personnels/{retired_personnel}', [RetiredPersonnelController::class, 'show'])->name('retired-personnels.show');
    Route::get('/scholarships', [ScholarshipController::class, 'index'])->name('scholarships.index');
    Route::get('/scholarships/{scholarship}', [ScholarshipController::class, 'show'])->name('scholarships.show');
    Route::get('/scholarship-applications', [ScholarshipApplicationController::class, 'index'])->name('scholarship-applications.index');
    Route::get('/scholarship-applications/{scholarship_application}', [ScholarshipApplicationController::class, 'show'])->name('scholarship-applications.show');
    Route::get('/structure-profiles', [StructureProfileController::class, 'index'])->name('structure-profiles.index');
    Route::get('/structure-profiles/{structure_profile}', [StructureProfileController::class, 'show'])->name('structure-profiles.show');
    Route::get('/student-admissions', [StudentAdmissionController::class, 'index'])->name('student-admissions.index');
    Route::get('/student-admissions/{student_admission}', [StudentAdmissionController::class, 'show'])->name('student-admissions.show');
    Route::get('/student-applications', [StudentApplicationController::class, 'index'])->name('student-applications.index');
    Route::get('/student-applications/{student_application}', [StudentApplicationController::class, 'show'])->name('student-applications.show');
    Route::get('/student-graduations', [StudentGraduationController::class, 'index'])->name('student-graduations.index');
    Route::get('/student-graduations/{student_graduation}', [StudentGraduationController::class, 'show'])->name('student-graduations.show');
    Route::get('/student-internships', [StudentInternshipController::class, 'index'])->name('student-internships.index');
    Route::get('/student-internships/{student_internship}', [StudentInternshipController::class, 'show'])->name('student-internships.show');
    Route::get('/student-status-histories', [StudentStatusHistoryController::class, 'index'])->name('student-status-histories.index');
    Route::get('/student-status-histories/{student_status_history}', [StudentStatusHistoryController::class, 'show'])->name('student-status-histories.show');
});

// Route::get('/transformer/source1', function (Request $request) {
//     // Sample data from source1
//     $source1Data = [
//         [
//             'id' => '6431311921',
//             'full_name' => 'John Does',
//             'email_address' => 'john.doe@example.com',
//             'password' => '123456',
//             'registration_date' => '2025-01-01 12:00:00',
//             'about_me' => 'A short about_me about Johnnnn.',
//             'profile_picture' => 'john_profile_picture.jpg',
//         ],
//         [
//             'id' => '6431311922',
//             'full_name' => 'Alice Johnson',
//             'email_address' => 'alice.johnson@example.com',
//             'password' => '123456',
//             'registration_date' => '2025-02-10 15:30:00',
//             'about_me' => 'Passionate about tech and programming.',
//             'profile_picture' => 'alice_profile_picture.jpg',
//         ],
//         [
//             'id' => '6431311923',
//             'full_name' => 'Bob Smith',
//             'email_address' => 'bob.smith@example.com',
//             'password' => '123456',
//             'registration_date' => '2025-03-25 09:00:00',
//             'about_me' => 'Loves hiking and outdoor adventures.',
//             'profile_picture' => 'bob_profile_picture.jpg',
//         ]
//     ];

//     $source1Id = DataSource::where("name", "=", "source1")->latest()->value('id');

//     $formattedData1 = DataTransformer::transformFromSource($source1Id, $source1Data);

//     return $formattedData1;
// })->middleware('client:machine');

// Route::get('/transformer/source2', function (Request $request) {
//     $source2Data = [
//         [
//             'id' => '1',
//             'username' => 'Jane Smith',
//             'contact_email' => 'jane.smith@example.com',
//             'signup_date' => '1712490600',
//             'bio_info' => 'A short bio_info about Jane.',
//             'image_url' => 'jane_image_url.jpg',
//         ],
//         [
//             'id' => '2',
//             'username' => 'Michael Taylor',
//             'contact_email' => 'michael.taylor@example.com',
//             'signup_date' => '1712490600',
//             'bio_info' => 'Software engineer with a love for gaming.',
//             'image_url' => 'michael_image_url.jpg',
//         ],
//         [
//             'id' => '3',
//             'username' => 'Sophia Davis',
//             'contact_email' => 'sophia.davis@example.com',
//             'signup_date' => '1712490600',
//             'bio_info' => 'Designs websites and UX interfaces.',
//             'image_url' => 'sophia_image_url.jpg',
//         ],
//         [
//             'id' => '4',
//             'username' => 'Ethan Wilson',
//             'contact_email' => 'ethan.wilson@example.com',
//             'signup_date' => '1712490600',
//             'bio_info' => 'Photographer and nature lover.',
//             'image_url' => 'ethan_image_url.jpg',
//         ],
//         [
//             'id' => '5',
//             'username' => 'Olivia Martinez',
//             'contact_email' => 'olivia.martinez@example.com',
//             'signup_date' => '1712490600',
//             'bio_info' => 'Creative writer and content strategist.',
//             'image_url' => 'olivia_image_url.jpg',
//         ],
//     ];

//     $source2Id = DataSource::where("name", "=", "source2")->latest()->value('id');

//     $formattedData1 = DataTransformer::transformFromSource($source2Id, $source2Data);

//     return $formattedData1;
// })->middleware('client:machine');

// Route::get('/transformer/source3', function (Request $request) {
//     $source3Data = [
//         [
//             'id' => '1',
//             'username' => 'Jane Smith',
//             'contact_email' => 'jane.smith@example.com',
//         ],
//         [
//             'id' => '2',
//             'username' => 'Michael Taylor',
//             'contact_email' => 'michael.taylor@example.com',
//         ],
//         [
//             'id' => '3',
//             'username' => 'Sophia Davis',
//             'contact_email' => 'sophia.davis@example.com',
//         ],
//         [
//             'id' => '4',
//             'username' => 'Ethan Wilson',
//             'contact_email' => 'ethan.wilson@example.com',
//         ],
//         [
//             'id' => '5',
//             'username' => 'Olivia Martinez',
//             'contact_email' => 'olivia.martinez@example.com',
//         ],
//     ];

//     $source3Id = DataSource::where("name", "=", "source3")->latest()->value('id');

//     $formattedData1 = DataTransformer::transformFromSource($source3Id, $source3Data);

//     return $formattedData1;
// })->middleware('client:machine');

// Route::get('/transformer/source4', function (Request $request) {
//     // Sample data from source1
//     $source1Data = [
//         [
//             'id' => '6431311921',
//             'full_name' => 'John Does',
//             'email_address' => 'john.doe@example.com',
//             'password' => '123456',
//             'registration_date' => '2025-01-01 12:00:00',
//             'about_me' => 'A short about_me about Johnnnn.',
//             'profile_picture' => 'john_profile_picture.jpg',
//         ],
//         [
//             'id' => '6431311922',
//             'full_name' => 'Alice Johnson',
//             'email_address' => 'alice.johnson@example.com',
//             'password' => '123456',
//             'registration_date' => '2025-02-10 15:30:00',
//             'about_me' => 'Passionate about tech and programming.',
//             'profile_picture' => 'alice_profile_picture.jpg',
//         ],
//         [
//             'id' => '6431311923',
//             'full_name' => 'Bob Smith',
//             'email_address' => 'bob.smith@example.com',
//             'password' => '123456',
//             'registration_date' => '2025-03-25 09:00:00',
//             'about_me' => 'Loves hiking and outdoor adventures.',
//             'profile_picture' => 'bob_profile_picture.jpg',
//         ]
//     ];

//     $source1Id = DataSource::where("name", "=", "source4")->latest()->value('id');

//     $formattedData1 = DataTransformer::transformFromSource($source1Id, $source1Data);

//     return $formattedData1;
// })->middleware('client:machine');
