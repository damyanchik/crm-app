<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\AuthenticateRequest;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    use AuthenticatesUsers, VerifiesEmails;

    public function __construct(protected AuthService $authService)
    {
    }

    public function login(): View
    {
        return view('layout');
    }

    public function show(): View
    {
        return view('auth.show');
    }

    public function authenticate(AuthenticateRequest $request): RedirectResponse
    {
        if (!auth()->attempt($request->validated())) {
            return back()
                ->withErrors(['email' => 'Niepoprawny email lub hasło.'])
                ->onlyInput('email');
        }
        $this->authService->authenticate($request);

        return redirect()
            ->route('dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $this->authService->logout($request);

        return redirect()
            ->route('login')
            ->with('message', 'Zostałeś wylogowany.');
    }

    public function resend(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()
                ->route('dashboard')
                ->with('message', 'Konto aktywowane.');
        }
        $this->authService->resend($request);

        return back()
            ->with('resent', true);
    }

    protected function verified(Request $request): RedirectResponse
    {
        return redirect($this->redirectPath())
            ->with('verified', true)
            ->with('message', 'Dziękujemy! Twój adres e-mail został pomyślnie zweryfikowany.');
    }

    protected function redirectTo(): string
    {
        return '/';
    }
}
