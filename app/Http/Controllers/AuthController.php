<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(): object
    {
        return view('layout');
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
}
