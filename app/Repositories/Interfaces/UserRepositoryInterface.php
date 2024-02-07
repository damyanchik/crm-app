<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function store(array $data): void;
    public function setPassword(User $user, $validatedData): void;
    public function toggleBlock(User $user): void;
    public function setAvatar(User $user): void;
}
