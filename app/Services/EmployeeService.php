<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\PhotoHelper;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmployeeService
{
    public function getUsers(): object
    {
        return User::search(request('search'))
            ->sortBy(
                request('column') ?? 'id',
                request('order') ?? 'asc'
            )->paginate(request('display'));
    }

    public function validateAndUpdate(FormRequest $request, User $user): void
    {
        $validatedData = $request->validated();

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            if ($user->avatar)
                PhotoHelper::deletePreviousPhoto($user->photo);
            $validatedData['avatar'] = $request->file('avatar')->store('images/avatars', 'public');
        }

        $user->update($validatedData);
    }

    public function validateAndChangePassword(FormRequest $request, User $user): void
    {
        $formPassword = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update(['password' => Hash::make($formPassword['password'])]);
    }

    public function checkAndSetBlock(User $user): void
    {
        $status = $user->getAttribute('block') == 1 ? 0 : 1;

        $user->setAttribute('block', $status);
        $user->save();
    }

    public function checkAndDeleteAvatar(User $user): void
    {
        if ($user->avatar) {
            PhotoHelper::deletePreviousPhoto($user->avatar);
        }

        $user->setAttribute('avatar', null);
        $user->save();
    }

    public function checkRoleAndChange(FormRequest $request, User $user): void
    {
        $role = Role::where('id', $request->id)->first();

        if ($role !== null) {
            $user->syncRoles([]);
            $user->assignRole($role);
        } else
            $user->syncRoles([]);
    }
}
