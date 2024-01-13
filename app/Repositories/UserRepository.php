<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Helpers\PhotoHelper;
use App\Models\User;
use App\Traits\SearchableTrait;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    use SearchableTrait;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function store(array $data): void
    {
        $data['password'] = Hash::make($data['password']);

        parent::store($data);
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
