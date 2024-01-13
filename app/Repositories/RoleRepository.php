<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function getById(int $id)
    {
        return Role::where('id', $id)->first();
    }

    public function store(array $validatedData): void
    {
        Role::create($validatedData);
    }

    public function destroy(Role $role): void
    {
        $role->syncPermissions([]);
        $role->delete();
    }

    public function assignPermissions(array $rolesAndPermissions): void
    {
        foreach ($rolesAndPermissions as $role => $permission) {
            $currentRole = Role::findById($role);
            if ($currentRole->name == 'admin')
                continue;

            $currentRole->syncPermissions($permission);
            $currentRole->setUpdatedAt(now());
        }
    }
}
