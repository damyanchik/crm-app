<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;

class PermissionService
{
    public function __construct(protected PermissionRepository $permissionRepository, protected RoleRepository $roleRepository)
    {
    }

    public function assignPermissionsToRole(array $rolesAndPermissions): void
    {
        unset($rolesAndPermissions['_token']);
        $this->roleRepository->assignPermissions($rolesAndPermissions);
    }

    public function groupPermissionNamesBySuffixForView(): array
    {
        $suffixNames = [
            'Offer',
            'OrderObserver',
            'Product',
            'Brand',
            'ProductCategory',
            'Client',
            'User',
            'Calendar',
            'Admin'
        ];

        return $this->groupPermissionNamesBySuffixes($this->permissionRepository->getToArray(), $suffixNames);
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
