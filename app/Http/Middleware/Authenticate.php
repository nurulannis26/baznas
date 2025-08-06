<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // dd($request->expectsJson());
        // if (! $request->expectsJson()) {
        //     return route('login');
        // }

        // dd(Auth::check());

        if (auth()->check()) {
            return null; // Sudah login, tidak usah redirect
        }

        if (! $request->expectsJson()) {
            return route('login');
        }

        return null; // default fallback
    }
}
