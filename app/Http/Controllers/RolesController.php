<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    private RoleService $roleService;
    private PermissionService $permissionService;

    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    public function index(): object
    {
        $roles = Role::get();
        $groupedPermissions = $this->permissionService->groupPermissionNamesBySuffixForView();

        return view('admin.roles_permissions', [
            'roles' => $roles,
            'permissions' => $groupedPermissions
        ]);
    }

    public function storeRole(Request $request): object
    {
        $this->roleService->validateAndStore($request);

        return back()->with('Utworzono nową rolę.');
    }

    public function storePermission(Request $request): object
    {
        $this->permissionService->assignPermissionsToRole($request);

        return back()->with('Wprowadzono zmiany w uprawnieniach.');
    }

    public function destroyRole(Role $role): object
    {
        $role->syncPermissions([]);
        $role->delete();

        return back()->with('Usunięto rolę.');
    }
}
