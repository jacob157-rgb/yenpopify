<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // jika belum login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // jika role tidak sesuai
        if (auth()->user()->role !== $role) {
            return abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
