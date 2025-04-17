# Authentication and Authorization with Laravel Passport

## Overview

This document outlines the implementation of authentication and authorization using **Laravel Passport**, focusing on managing access control through **OAuth2 scopes** and **Role-Based Access Control (RBAC)**.

📘 Laravel Passport Docs: [Laravel Passport Documentation](https://laravel.com/docs/11.x/passport)

## Key Concepts

### Definitions

- **User**: A direct user of the resource server, typically accessing it through a frontend provided by the server.
- **Resource Owner**: The owner of the data within the resource server (e.g., a student in a student record system).
- **Server**: The resource server that holds and serves protected data.
- **Client**: An application (either third-party or internal) that accesses the resource server via OAuth2.
- **Scopes**: OAuth2 mechanism for broad access control.
- **RBAC (Role-Based Access Control)**: A method of defining access based on roles and associated permissions.
- **Role**: A group of permissions.
- **Permission**: Specifies allowed actions on specific resources and fields.

## General Structure

### Authentication

- **Users** authenticate using traditional register/login mechanisms.
- **Clients** authenticate using **OAuth2** provided by Laravel Passport.

### Authorization

- **Scopes** restrict which API endpoints a client can access.
- **RBAC** restricts what actions (e.g., view, update) a user or client can perform on specific models and their fields.
- There is also middleware for checking **role names**, similar to how scopes are used. Syntax: `role:<role_name1>,<role_name2>`. While not used currently, it may support future use cases.

### Role Assignment

- A **user** can have many roles.
- A **client** can also have many roles.
- Roles (and thus permissions) can be assigned during creation or later by an administrator.
- Clients may request any scopes unless restricted by a separate table tracking allowed scopes per client.

## Middleware Workflow

Laravel uses up to three layers of middleware for access control:

### Laravel / Laravel Passport Middleware

- `auth:api`: Authenticates the user or client.
- `scopes:<scope>` or `client:<scope>`: Validates if the client has the required scopes.

### Custom Middleware

- `permission:<action>|<model>`: Checks if the authenticated user or client has the required permission. If permission is granted, it attaches the allowed viewable columns to the request for downstream usage.
- `role:<role_name1>,<role_name2>`: (Optional) Checks if the authenticated user/client has one of the specified roles. Currently not in use.

### Middleware Execution Flow

1. `auth:api` authenticates the request.
2. `scopes:<scope>` ensures the client has the required scope.
3. `permission:<action>|<model>` checks for the required permission.
4. If any check fails, a `403 Unauthorized` response is returned.
5. If successful, viewable columns are attached to the request for further processing.

## Use Cases

### 1. Direct User Access to Server

When a user accesses the server directly (e.g., using a web or mobile frontend), the system enforces RBAC using the user's roles and permissions.

**Setup**

- The user registers and logs in.

**Example**

```php
// Route for internal API access
Route::middleware(['auth:api'])->prefix('internal')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('permission:view|App\Models\User');
});
```

### 2. User Access via a Client (Authorization Code Grant)

In this case, a client (e.g., a third-party app) acts on behalf of a user.

**Flow**

- The user registers and logs in.
- The user creates a client (registers the app with name and redirect URL).
- The client follows the **Authorization Code Grant** flow as per Laravel Passport.
- The client uses the acquired access token to call APIs.
- Middleware validates the token, scope, and permissions.

**Example**

```php
// Route for client auth code access
Route::middleware(['auth:api', 'scopes:user.read'])->prefix('external')->group(function () {
    Route::get('/user', function (Request $request) {
        $user = $request->user();
        $viewableColumns = $request->get('viewableColumns');
        $userData = User::select($viewableColumns)->where('id', $user->id)->first();
        return $userData;
    })->middleware('permission:view|App\Models\User');
});
```

### 3. Client-Only Access (Client Credentials Grant)

A client accesses the server without a user context, using the **Client Credentials Grant**.

**Flow**

- The user registers and logs in.
- The user creates a client (providing name and redirect URL).
- The client follows the Client Credentials Grant flow.
- The client uses the access token to call server APIs.
- Middleware ensures proper authorization.

**Example**

```php
Route::middleware(['client:admin.read', 'permission:view|App\Models\User'])->prefix('client')->group(function () {
    Route::get('/users', function (Request $request) {
        $viewableColumns = $request->get('viewableColumns');
        $userData = User::select($viewableColumns)->get();
        return $userData;
    });
});
```

### 4. Dynamic Endpoints with Permission Checking

You can define dynamic endpoints where permission is validated based on the model requested.

**Example**

```php
Route::middleware('auth:api')->get('/resource/{entity}', function (Request $request, $entity) {     
    // Check if the table exists
    if (!Schema::hasTable($entity)) {
        abort(404, "Table not found");
    }

    $modelClass = 'App\\Models\\' . Str::studly(Str::singular($entity));

    if (!class_exists($modelClass)) {
        abort(404, "Model not found");
    }
    // Check permission
    $permissionService = app(PermissionService::class);
    $viewableColumns = $permissionService->allowedColumns($request->user(), 'view', $modelClass);
    if (empty($viewableColumns)) {
        abort(403, "No permission to view any columns");
    }

    $data = $modelClass::select($viewableColumns)->get();

    return response()->json($data);
});
```

---

## 🔧 Next Steps

- Define and add more scopes following best practices: [Scope Best Practices](https://curity.io/resources/learn/scope-best-practices/). (Note: current implementation is a Proof of Concept, and existing scopes may be insufficient.)
- Add more preset roles and permissions to support scalable access control.

---