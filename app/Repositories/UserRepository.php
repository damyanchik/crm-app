<?php

namespace App\Repositories;

use App\Helpers\PhotoHelper;
use App\Models\User;
use App\Traits\SearchableTrait;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    use SearchableTrait;

    public function getAll(array $searchParams): object
    {
        return $this->searchAndSort(new User(), $searchParams);
    }

    public function store(array $validatedData): void
    {
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
    }

    public function update(User $user, array $validatedData): void
    {
        $user->update($validatedData);
    }

    public function setPassword(User $user, $validatedData): void
    {
        $user->setAttribute('password', Hash::make($validatedData));
        $user->save();
    }

    public function toggleBlock(User $user): void
    {
        $status = $user->getAttribute('block') == 1 ? 0 : 1;

        $user->setAttribute('block', $status);
        $user->save();
    }

    public function setAvatar(User $user): void
    {
        if ($user->avatar) {
            PhotoHelper::deletePreviousPhoto($user->avatar);
        }

        $user->setAttribute('avatar', null);
        $user->save();
    }
}
