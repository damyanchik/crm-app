<?php

declare(strict_types=1);

namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository
{
    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }

    public function getToArray(): array
    {
        return Permission::get()->toArray();
    }
}
