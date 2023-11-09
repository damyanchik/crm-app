<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateLastActivity
{
    public function handle(Request $request, Closure $next): object
    {
        $response = $next($request);

        if (Auth::check()) {
            $lastActivity = Auth::user()->last_activity;

            if (now()->subMinutes(config('auth.guards.web.timeout')) > $lastActivity) {
                Auth::user()->update(['last_activity' => now()]);
            }
        }

        return $response;
    }
}
