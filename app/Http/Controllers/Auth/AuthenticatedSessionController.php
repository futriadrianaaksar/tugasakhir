<?php

   namespace App\Http\Controllers\Auth;

   use App\Http\Controllers\Controller;
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Support\Facades\Auth;
   use Illuminate\Validation\ValidationException;

   class AuthenticatedSessionController extends Controller
   {
       public function create()
       {
           if (Auth::check()) {
               $user = Auth::user();
               if ($user->role === 'admin') {
                   return redirect()->route('admin.dashboard');
               } elseif ($user->role === 'dosen') {
                   return redirect()->route('dosen.dashboard');
               } else {
                   return redirect()->route('mahasiswa.dashboard');
               }
           }

           return view('auth.login');
       }

       public function store(Request $request): RedirectResponse
       {
           $request->validate([
               'email' => ['required', 'email'],
               'password' => ['required'],
           ], [
               'email.required' => 'Email wajib diisi.',
               'password.required' => 'Kata sandi wajib diisi.',
           ]);

           if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
               $request->session()->regenerate();

               $user = Auth::user();
               if ($user->role === 'admin') {
                   return redirect()->route('admin.dashboard');
               } elseif ($user->role === 'petugas') {
                   return redirect()->route('petugas.dashboard');
               } else {
                   return redirect()->route('mahasiswa.dashboard');
               }
           }

           throw ValidationException::withMessages([
               'email' => __('auth.failed'),
           ]);
       }

       public function destroy(Request $request): RedirectResponse
       {
           Auth::guard('web')->logout();

           $request->session()->invalidate();
           $request->session()->regenerateToken();

           return redirect('/');
       }
   }
