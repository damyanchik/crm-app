<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;

class AuthService
{
    public function authenticate(Request $request): void
    {
        $request->session()->regenerate();
    }

    public function logout(Request $request): void
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function resend(Request $request): void
    {
        $request->user()->sendEmailVerificationNotification();
    }
}
