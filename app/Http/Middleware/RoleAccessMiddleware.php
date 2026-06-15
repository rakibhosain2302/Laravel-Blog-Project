<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $roleName = optional($user->role)->name ?? 'Guest';

        if (!in_array($roleName, ['Admin', 'Editor'])) {
            return response()->view('admin.pages.error.404', [], 404);
        }

        return $next($request);
    }
}
