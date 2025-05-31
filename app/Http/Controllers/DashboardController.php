<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        if ($role === 'admin') {
            return view('admin.dashboard');
        } elseif ($role === 'petugas') {
            return view('petugas.dashboard');
        } elseif ($role === 'mahasiswa') {
            return view('mahasiswa.dashboard');
        }
        return view('dashboard');
    }
}
