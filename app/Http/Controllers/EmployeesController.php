<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmployeesController extends Controller
{
    public function index()
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

    public function show(User $user)
    {
        return view('employees.show', [
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        return view('employees.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {

        $formFields = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => ['required', 'email'],
            'phone' => 'nullable',
            'address' => 'nullable',
            'postal_code' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'position' => 'nullable',
            'department' => 'nullable'
        ]);

//        if ($request->hasFile('logo')) {
//            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
//        }

        $user->update($formFields);

        return back()->with('message', 'User updated successfully!');
    }

    public function block(User $user)
    {
        $status = $user->getAttribute('block') == 1 ? 0 : 1;

        $user->setAttribute('block', $status);
        $user->save();


        //niemozliwosc zablokowania siebie
        
        return back()->with('message', 'User updated successfully!');
    }
}
