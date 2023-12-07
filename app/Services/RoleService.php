<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function validateAndStore(Request $request): void
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        Role::create(['name' => $request->name]);
    }
}
