<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeesController extends Controller
{
    public function index(): object
    {
        $users = User::search(request('search'))->paginate(request('display'));

        return view('employees.index', [
            'users' => $users
        ]);
    }

    public function show(User $user): object
    {
        return view('employees.show', [
            'user' => $user,
        ]);
    }

    public function block(User $user): object
    {
        $status = $user->getAttribute('block') == 1 ? 0 : 1;

        $user->setAttribute('block', $status);
        $user->save();

        return back()->with('message', 'Zmiana statusu użytkownika!');
    }

    public function edit(User $user): object
    {
        return view('employees.edit', [
            'user' => $user,
        ]);
    }

    public function update(UpdateEmployeeRequest $request, User $user): object
    {

        $formFields = $request->validated();

        if ($request->hasFile('avatar')) {

            $request->validate([
                'avatar' => 'image|max:5120|dimensions:min_width=200,min_height=200,max_width=800,max_height=800',
            ]);

            if ($user->avatar) {
                $previousAvatarPath = 'public/' . $user->avatar;

                if (Storage::disk('local')->exists($previousAvatarPath)) {
                    Storage::disk('local')->delete($previousAvatarPath);
                }
            }

            $formFields['avatar'] = $request->file('avatar')->store('images/avatars', 'public');
        }

        $user->update($formFields);

        return back()->with('message', 'Użytkownik zaktualizowany!');
    }

    public function changePassword(Request $request)
    {
        $formPassword = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->update(['password' => Hash::make($formPassword['password'])]);

        return redirect()->route('home')->with('message', 'Nastąpiła zamiana hasła!');
    }

    public function deleteAvatar(User $user): object
    {
        if ($user->avatar) {
            $previousAvatarPath = 'public/' . $user->avatar;

            if (Storage::disk('local')->exists($previousAvatarPath)) {
                Storage::disk('local')->delete($previousAvatarPath);
            }
        }

        $user->setAttribute('avatar', null);
        $user->save();

        return back()->with('message', 'Usunięto zdjęcie profilowe.');
    }
}
