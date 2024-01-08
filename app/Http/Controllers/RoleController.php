<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct(
        protected RoleService       $roleService,
        protected PermissionService $permissionService
    )
    {
    }

    public function index(): View
    {
        return view('admin.roles_permissions', [
            'roles' => Role::get(),
            'permissions' => $this->permissionService->groupPermissionNamesBySuffixForView()
        ]);
    }

    public function storeRole(StoreRoleRequest $request): RedirectResponse
    {
        try {
            $this->roleService->store($request->validated());
            DB::commit();
            return back()->with('message', 'Utworzono nową rolę.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Wystąpił błąd w trakcie tworzenia roli!');
        }
    }

    public function storePermission(Request $request): RedirectResponse
    {
        try {
            $this->permissionService->assignPermissionsToRole($request->toArray());
            DB::commit();
            return back()->with('message', 'Wprowadzono zmiany w uprawnieniach ról.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Wystąpił błąd w trakcie przypisywania uprawnień!');
        }
    }

    public function destroyRole(Role $role): RedirectResponse
    {
        if ($role->name == 'admin')
            return back()->with('message', 'Brak możliwości usunięcia tej roli.');

        try {
            $this->roleService->destroy($role);
            return back()->with('message', 'Usunięto rolę i jej uprawnienia.');
        } catch (\Exception $e) {
            return back()->with('message', 'Wystąpił błąd w trakcie usuwania roli i uprawnień.');
        }
    }
}
