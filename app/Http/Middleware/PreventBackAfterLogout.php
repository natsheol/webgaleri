<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventBackAfterLogout
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Disable cache
        $response->headers->set('Cache-Control','no-cache, no-store, must-revalidate');
        $response->headers->set('Pragma','no-cache');
        $response->headers->set('Expires','0');

        // Jika admin sudah login dan buka login page, redirect ke dashboard
        if ($request->is('admin/login') && Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return $response;
    }
}
