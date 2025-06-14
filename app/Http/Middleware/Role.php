<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!in_array(auth()->user()->role, $roles)) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        return $next($request);
    }
}
