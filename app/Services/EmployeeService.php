<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\PhotoHelper;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;

class EmployeeService
{
    public function __construct(protected UserRepository $userRepository, protected RoleRepository $roleRepository)
    {
    }

    public function getAll(array $searchParams): object
    {
        return $this->userRepository->searchAndSort(new User(), $searchParams);
    }

    public function update(User $user, array $validatedData, object $file): void
    {
        if ($file->isValid()) {
            if ($user->avatar)
                PhotoHelper::deletePreviousPhoto($user->photo);

            $validatedData['avatar'] = $file->store('images/avatars', 'public');
        }

        $this->userRepository->update($user, $validatedData);
    }

    public function changePassword(User $user, array $validatedData): void
    {
        $this->userRepository->setPassword($user, $validatedData);
    }

    public function toggleBlock(User $user): void
    {
        $this->userRepository->toggleBlock($user);
    }

    public function checkAndDeleteAvatar(User $user): void
    {
        $this->userRepository->setAvatar($user);
    }

    public function checkRoleAndChange(User $user, int $roleId): void
    {
        $role = $this->roleRepository->getById($roleId);

        if ($role !== null) {
            $user->assignRole($role);
        }

        $user->syncRoles([]);
    }

    public function store(array $validatedData): void
    {
        $this->userRepository->store($validatedData);
    }
}
