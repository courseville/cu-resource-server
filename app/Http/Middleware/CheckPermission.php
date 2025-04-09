<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\PermissionService;

class CheckPermission
{
    public static function using(...$roles)
    {
        if (is_array($roles[0])) {
            return static::class.':'.implode(',', $roles[0]);
        }

        return static::class.':'.implode(',', $roles);
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $parameters): Response
    {
        [$action, $model] = explode('|', $parameters);
        $user = $request->user();
        $permissionService = app(PermissionService::class);
        if (!$user) {
            $client = auth('api')->client();
            if ($client) {
                $viewableColumns = $permissionService->allowedColumns($client, $action, $model);
                if (empty($viewableColumns)) {
                    return response()->json(['error' => 'Client have no permission to view any columns.'], 403);
                }
                $request->merge(['viewableColumns' => $viewableColumns]);
                return $next($request);
            }
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $viewableColumns = $permissionService->allowedColumns($user, $action, $model);
        if (empty($viewableColumns)) {
            return response()->json(['error' => 'User have no permission to view any columns.'], 403);
        }
        $request->merge(['viewableColumns' => $viewableColumns]);
        return $next($request);
    }
}
