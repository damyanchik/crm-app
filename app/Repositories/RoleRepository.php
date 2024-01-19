<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{
    const ADMIN = 'admin';

    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function assignPermissions(array $rolesAndPermissions): void
    {
        foreach ($rolesAndPermissions as $role => $permission) {
            $currentRole = $this->model->findById($role);

            if ($currentRole->name == self::ADMIN) {
                continue;
            }

            $currentRole->syncPermissions($permission);
            $currentRole->setUpdatedAt(now());
        }
    }

    public function destroy(Model|int $model): void
    {
        $currentModel = $this->checkModelOrInt($model);

        if ($currentModel->name == self::ADMIN) {
            throw new \Exception("Brak możliwości usunięcia roli administratora.");
        }

        $currentModel->delete();
    }
}
