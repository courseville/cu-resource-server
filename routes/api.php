<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Transformers\DataTransformer;
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

Route::get('/scopes', function (Request $request) {
    $scopes = Passport::scopes();

    return response()->json($scopes);
})->middleware('client:machine');

Route::middleware('auth:api')->get('/resources/{entity}', function (Request $request, $entity) {
    // Check if the table exists
    if (!Schema::hasTable($entity)) {
        abort(404, "Table not found");
    }

    $modelClass = 'App\\Models\\' . Str::studly(Str::singular($entity));

    Log::info($modelClass);
    if (!class_exists($modelClass)) {
        abort(404, "Model not found");
    }

    $data = $modelClass::get();

    return response()->json($data);
});

Route::get('/transformer', function (Request $request) {
    $fetchedDataArray = [
        [
            'full_name' => 'John Doe',
            'email_address' => 'JOhN@EXAMPLE.COM',
            'password' => 'hidden',
            'registration_date' => '2025-03-31T12:00:00Z'
        ],
        [
            'full_name' => 'Jane Smith',
            'email_address' => 'JANE@EXAMPLE.COM',
            'password' => 'hidden',
            'registration_date' => '2025-03-30T15:30:00Z'
        ]
    ];

    $formattedData = DataTransformer::transformArray($fetchedDataArray, new User());
    return $formattedData;
})->middleware('client:machine');



