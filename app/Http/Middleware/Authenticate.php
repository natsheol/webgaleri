<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $redirectUrl = $request->fullUrl();

            // If accessing admin area, send to admin login
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login', ['redirect' => $redirectUrl]);
            }

            // Default: user login
            return route('user.login', ['redirect' => $redirectUrl]);
        }
    }
}
