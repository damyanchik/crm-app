<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    public function getAll(): array
    {
        return Permission::get()->toArray();
    }
}
