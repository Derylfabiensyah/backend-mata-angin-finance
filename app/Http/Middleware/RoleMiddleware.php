<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        ...$roles
    ):response
    {
        if(!auth()->check()){
            return response()->json([
                'message' => 'Unauthorized',
            ],401);
        }

        if(!in_array(
            auth()->user()->role,
            $roles
        )) {
            return response()->json([
                'message' => 'Akses ditolak',
            ],403);
        }

        return $next($request);
    }
}
