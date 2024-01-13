<?php

declare(strict_types=1);

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function assignPermissions(array $rolesAndPermissions): void
    {
        foreach ($rolesAndPermissions as $role => $permission) {
            $currentRole = Role::findById($role);
            if ($currentRole->name == 'admin') {
                continue;
            }

            $currentRole->syncPermissions($permission);
            $currentRole->setUpdatedAt(now());
        }
    }
}
