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

Route::get('/scopes-nomid', function (Request $request) {
    $scopes = Passport::scopes();

    return response()->json($scopes);
});

// Route for internal API access
Route::middleware(['auth:api'])->prefix('internal')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// Route for client autho code access 
Route::middleware(['auth:api','scopes:user.read'])->prefix('external')->group(function () {
    Route::get('/user', function (Request $request) {
        $user = $request->user();
        $roles =  $user->roles;
        $permissions = $roles->flatMap(function ($role) {
            return $role->permissions;
        });
        \Log::info($permissions);
        // Filter permissions where the model is 'User' and the action is 'view'
        $filteredPermissions = $permissions->filter(function ($permission) {
            // Dynamically resolve the model instance
            $modelInstance = $permission->modelInstance();

            // Check if the model is 'User' and the action is 'view'
            return $modelInstance instanceof App\Models\User && $permission->action === 'view';
        });
        \Log::info($filteredPermissions);
        // Get unique viewable columns from the filtered permissions
        $viewableColumns = $filteredPermissions->pluck('columns')->flatten()->map(function ($column) {
            return json_decode($column, true); // Decode JSON into an array
        })->flatten()->unique()->toArray();

        // If no columns are specified, return all columns
        if (empty($viewableColumns)) {
            return response()->json(['error' => 'No permission to view any columns.'], 403);
        }
        \Log::info($viewableColumns);
        $userData = User::select($viewableColumns)->where('id', $user->id)->first();
        return $userData;
    })->middleware('role:admin,student');
});

// Route for client no user data access
Route::middleware('client:general.read,machine')->group(function () {
    Route::get('/scopes', function (Request $request) {
        $scopes = Passport::scopes();
        return response()->json($scopes);
    });
});

// Route for client user data access
Route::middleware(['client:admin.read','roles:client_full_access'])->prefix('client')->group(function () {
    Route::get('/users', function (Request $request) {
        return User::get();
    });
});

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

Route::get('/transformer/source1', function (Request $request) {
    // Sample data from source1
    $source1Data = [
        [
            'id' => '1',
            'full_name' => 'John Doe',
            'email_address' => 'john.doe@example.com',
            'registration_date' => '2025-01-01 12:00:00',
            'about_me' => 'A short about_me about John.',
            'profile_picture' => 'john_profile_picture.jpg',
        ],
        [
            'id' => '2',
            'full_name' => 'Alice Johnson',
            'email_address' => 'alice.johnson@example.com',
            'registration_date' => '2025-02-10 15:30:00',
            'about_me' => 'Passionate about tech and programming.',
            'profile_picture' => 'alice_profile_picture.jpg',
        ],
        [
            'id' => '3',
            'full_name' => 'Bob Smith',
            'email_address' => 'bob.smith@example.com',
            'registration_date' => '2025-03-25 09:00:00',
            'about_me' => 'Loves hiking and outdoor adventures.',
            'profile_picture' => 'bob_profile_picture.jpg',
        ],
        [
            'id' => '4',
            'full_name' => 'Charlie Brown',
            'email_address' => 'charlie.brown@example.com',
            'registration_date' => '2025-04-05 18:45:00',
            'about_me' => 'Musician and graphic designer.',
            'profile_picture' => 'charlie_profile_picture.jpg',
        ],
        [
            'id' => '5',
            'full_name' => 'David Green',
            'email_address' => 'david.green@example.com',
            'registration_date' => '2025-05-15 13:30:00',
            'about_me' => 'Tech enthusiast and web developer.',
            'profile_picture' => 'david_profile_picture.jpg',
        ],
    ];


    $formattedData1 = DataTransformer::transformFromSource('source1', $source1Data);

    return $formattedData1;
})->middleware('client:machine');

Route::get('/transformer/source2', function (Request $request) {
    $source2Data = [
        [
            'id' => '1',
            'username' => 'Jane Smith',
            'contact_email' => 'jane.smith@example.com',
            'signup_date' => '2025-01-02 12:00:00',
            'bio_info' => 'A short bio_info about Jane.',
            'image_url' => 'jane_image_url.jpg',
        ],
        [
            'id' => '2',
            'username' => 'Michael Taylor',
            'contact_email' => 'michael.taylor@example.com',
            'signup_date' => '2025-02-12 16:30:00',
            'bio_info' => 'Software engineer with a love for gaming.',
            'image_url' => 'michael_image_url.jpg',
        ],
        [
            'id' => '3',
            'username' => 'Sophia Davis',
            'contact_email' => 'sophia.davis@example.com',
            'signup_date' => '2025-03-20 14:15:00',
            'bio_info' => 'Designs websites and UX interfaces.',
            'image_url' => 'sophia_image_url.jpg',
        ],
        [
            'id' => '4',
            'username' => 'Ethan Wilson',
            'contact_email' => 'ethan.wilson@example.com',
            'signup_date' => '2025-04-10 11:00:00',
            'bio_info' => 'Photographer and nature lover.',
            'image_url' => 'ethan_image_url.jpg',
        ],
        [
            'id' => '5',
            'username' => 'Olivia Martinez',
            'contact_email' => 'olivia.martinez@example.com',
            'signup_date' => '2025-05-25 17:45:00',
            'bio_info' => 'Creative writer and content strategist.',
            'image_url' => 'olivia_image_url.jpg',
        ],
    ];

    $formattedData1 = DataTransformer::transformFromSource('source2', $source2Data);

    return $formattedData1;
})->middleware('client:machine');

Route::get('/transformer/source3', function (Request $request) {
    $source2Data = [
        [
            'id' => '1',
            'username' => 'Jane Smith',
            'contact_email' => 'jane.smith@example.com',
        ],
        [
            'id' => '2',
            'username' => 'Michael Taylor',
            'contact_email' => 'michael.taylor@example.com',
        ],
        [
            'id' => '3',
            'username' => 'Sophia Davis',
            'contact_email' => 'sophia.davis@example.com',
        ],
        [
            'id' => '4',
            'username' => 'Ethan Wilson',
            'contact_email' => 'ethan.wilson@example.com',
        ],
        [
            'id' => '5',
            'username' => 'Olivia Martinez',
            'contact_email' => 'olivia.martinez@example.com',
        ],
    ];

    $formattedData1 = DataTransformer::transformFromSource('source3', $source2Data);

    return $formattedData1;
})->middleware('client:machine');



