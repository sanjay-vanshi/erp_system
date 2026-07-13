<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = Auth::user();

        // User must be logged in
        if (! $user) {

            abort(401);

        }

        // User must have a role
        if (! $user->role) {

            abort(403, 'No role assigned.');

        }

        // Check permission
        if (! $user->hasPermission($permission)) {

            abort(403, 'Unauthorized.');

        }

        return $next($request);
    }
}
