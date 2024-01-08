<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\PhotoHelper;
use App\Http\Requests\IndexRequest;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmployeeService
{
    public function __construct(protected SearchService $searchService)
    {
    }

    public function getAll(IndexRequest $indexRequest): object
    {
        return $this->searchService->searchItems(new User(), $indexRequest);
    }

    public function update(User $user, FormRequest $request): void
    {
        $validatedData = $request->validated();

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            if ($user->avatar)
                PhotoHelper::deletePreviousPhoto($user->photo);
            $validatedData['avatar'] = $request->file('avatar')->store('images/avatars', 'public');
        }

        $user->update($validatedData);
    }

    public function changePassword(User $user, FormRequest $request): void
    {
        $user->update(['password' => Hash::make($request->validated())]);
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

    public function checkRoleAndChange(User $user, int $roleId): void
    {
        $role = Role::where('id', $roleId)->first();

        if ($role !== null) {
            $user->syncRoles([]);
            $user->assignRole($role);
        } else
            $user->syncRoles([]);
    }

    public function store(array $validatedData): void
    {
        $formFields = $validatedData;
        $formFields['password'] = Hash::make($formFields['password']);

        User::create($formFields);
    }
}
