<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function __construct(
        protected RoleService       $roleService,
        protected PermissionService $permissionService
    )
    {
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
        try {
            $this->roleService->validateAndStore($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Wystąpił błąd w trakcie tworzenia roli!');
        }

        return back()->with('message', 'Utworzono nową rolę.');
    }

    public function storePermission(Request $request): object
    {
        try {
            $this->permissionService->assignPermissionsToRole($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Wystąpił błąd w trakcie przypisywania uprawnień!');
        }
        return back()->with('message', 'Wprowadzono zmiany w uprawnieniach ról.');
    }

    public function destroyRole(Role $role): object
    {
        if ($role->name == 'admin')
            return back()->with('message', 'Brak możliwości usunięcia tej roli.');

        $role->syncPermissions([]);
        $role->delete();

        return back()->with('message', 'Usunięto rolę i jej uprawnienia.');
    }
}
