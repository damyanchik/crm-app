<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function store(FormRequest $formField): void
    {
        Role::create($formField->validated());
    }

    public function destroy(Role $role): void
    {
        $role->syncPermissions([]);
        $role->delete();
    }
}
