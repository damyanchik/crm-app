<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class EmployeesController extends Controller
{
    public function index(): object
    {
        $users = User::where(function($query) {
            $query->orWhere('name', 'like', '%' . request('search') . '%')
                ->orWhere('surname', 'like', '%' . request('search') . '%')
                ->orWhere('email', 'like', '%' . request('search') . '%')
                ->orWhere('phone', 'like', '%' . request('search') . '%')
                ->orWhere('address', 'like', '%' . request('search') . '%')
                ->orWhere('postal_code', 'like', '%' . request('search') . '%')
                ->orWhere('city', 'like', '%' . request('search') . '%')
                ->orWhere('state', 'like', '%' . request('search') . '%')
                ->orWhere('country', 'like', '%' . request('search') . '%')
                ->orWhere('position', 'like', '%' . request('search') . '%')
                ->orWhere('department', 'like', '%' . request('search') . '%');
        })->paginate(request('display'));

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

    public function block(User $user): object
    {
        $status = $user->getAttribute('block') == 1 ? 0 : 1;

        $user->setAttribute('block', $status);
        $user->save();


        //brak mozl zablokowania siebie dodac +

        return back()->with('message', 'Zmiana statusu użytkownika!');
    }
}
