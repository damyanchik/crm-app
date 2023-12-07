<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionService
{
    public function assignPermissionsToRole(Request $request): void
    {
        $rolesAndPermissions = $request->toArray();
        unset($rolesAndPermissions['_token']);

        DB::beginTransaction();

        try {
            foreach ($rolesAndPermissions as $role => $permission) {
                $currentRole = Role::findById($role);
                $currentRole->syncPermissions($permission);
                $currentRole->setUpdatedAt(now());
            }

            DB::commit();
            Session::flash('success', 'Zmiany w uprawnieniach zostały wprowadzone.');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Błąd w trakcie nadawania uprawnień, spróbuj ponownie!');
        }
    }

    public function groupPermissionNamesBySuffixForView(): array
    {
        $permissions = Permission::get()->toArray();

        $suffixNames = [
            'Offer',
            'Order',
            'Product',
            'Brand',
            'ProductCategory',
            'Client',
            'User',
            'Calendar',
            'Admin'
        ];

        return $this->groupPermissionNamesBySuffixes($permissions, $suffixNames);
    }

    private function groupPermissionNamesBySuffixes(array $names, array $suffixes): array
    {
        $groupedTasks = [];

        foreach ($names as $name) {
            $matchedSuffix = null;
            foreach ($suffixes as $suffix) {
                if (str_ends_with($name['name'], $suffix)) {
                    $matchedSuffix = $suffix;
                    break;
                }
            }
            $groupedTasks[$matchedSuffix ?? 'Other'][] = $name;
        }

        return $groupedTasks;
    }
}
