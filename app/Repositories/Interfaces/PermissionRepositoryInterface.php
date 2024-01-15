<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use Spatie\Permission\Models\Permission;

interface PermissionRepositoryInterface
{
    public function __construct(Permission $model);
    public function getToArray(): array;
}
