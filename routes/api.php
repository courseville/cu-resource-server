<?php

use App\Models\DynamicModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
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
    if (!Schema::hasTable($entity)) {
        abort(404, "Table not found");
    }

    $scopes = [
        'users' => 'admin',
    ];

    if (isset($scopes[$entity]) && !$request->user()->tokenCan($scopes[$entity])) {
        abort(403, "Unauthorized: Missing scope {$scopes[$entity]}");
    }

    $model = (new DynamicModel())->setTableName($entity);
    return response()->json($model->get());
});

