<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\RoleRepository;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function __construct(protected RoleRepository $repository)
    {
    }

    public function store(array $validatedData): void
    {
        $this->repository->store($validatedData);
    }

    public function destroy(Role $role): void
    {
        $this->repository->destroy($role);
    }

    public function getAll(): object
    {
        return $this->repository->getAll();
    }
}
