<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
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
