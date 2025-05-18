<?php

     namespace App\Http\Middleware;

     use Closure;
     use Illuminate\Http\Request;
     use Illuminate\Support\Facades\Auth;

     class Role
     {
         public function handle(Request $request, Closure $next, ...$roles)
         {
             if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
                 abort(403, 'Aksi tidak diizinkan.');
             }

             return $next($request);
         }
     }
