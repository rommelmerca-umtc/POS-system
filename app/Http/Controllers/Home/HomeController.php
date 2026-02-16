<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == 1) {
                return redirect()->route('admin.dashboard.index');
            }

            if (Auth::user()->role_id == 2) {
                return redirect()->route('user.dashboard.index');
            }
        }

        // Render the Welcome page for guests
        return Inertia::render('Auth/Login', [
            'canLogin'         => app('router')->has('login'),
            'canRegister'      => app('router')->has('register'),
            'canResetPassword' => app('router')->has('password.request'),
            'laravelVersion'   => Application::VERSION,
            'phpVersion'       => PHP_VERSION,
        ]);
    }
}
