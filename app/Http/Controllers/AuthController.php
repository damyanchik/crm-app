<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\AuthenticateRequest;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthenticatesUsers, VerifiesEmails;

    public function login(): object
    {
        return view('layout');
    }

    public function show(): object
    {
        return view('auth.show');
    }

    public function authenticate(AuthenticateRequest $request): object
    {
        $formFields = $request->validated();

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Niepoprawny email lub hasło.'
        ])->onlyInput('email');
    }

    public function logout(Request $request): object
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message', 'Zostałeś wylogowany.');
    }

    public function resend(Request $request): object
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/')->with('message', 'Konto aktywowane.');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }

    protected function redirectTo(): string
    {
        return '/';
    }

    protected function verified(Request $request): object
    {
        return redirect($this->redirectPath())
            ->with('verified', true)
            ->with('message', 'Dziękujemy! Twój adres e-mail został pomyślnie zweryfikowany.');
    }
}
