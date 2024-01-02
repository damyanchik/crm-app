<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function store(array $formField): void
    {
        Role::create(['name' => $formField['name']]);
    }

    public function destroy(Role $role): void
    {
        $role->syncPermissions([]);
        $role->delete();
    }
}
