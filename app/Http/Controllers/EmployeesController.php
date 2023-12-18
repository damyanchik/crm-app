<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\User;
use App\Services\EmployeeService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class EmployeesController extends Controller
{
    public function __construct(protected EmployeeService $employeeService)
    {
    }

    public function index(): object
    {
        return view('employees.index', [
            'users' => $this->employeeService->getUsers()
        ]);
    }

    public function show(User $user): object
    {
        return view('employees.show', [
            'user' => $user,
        ]);
    }

    public function block(User $user): object
    {
        $this->employeeService->checkAndSetBlock($user);

        return back()->with(
            'message',
            'Zmiana statusu użytkownika!'
        );
    }

    public function edit(User $user): object
    {
        return view('employees.edit', [
            'user' => $user,
            'roles' => Role::get()
        ]);
    }

    public function update(UpdateEmployeeRequest $request, User $user): object
    {
        DB::beginTransaction();

        try {
            $this->employeeService->validateAndUpdate($request, $user);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Nastąpił błąd w trakcie dodawania nowych produktów!');
        }
        return back()->with(
            'message',
            'Użytkownik zaktualizowany!'
        );
    }

    public function changePassword(FormRequest $request, User $user): object
    {
        $this->employeeService->validateAndChangePassword($request, $user);

        return back()->with(
            'message',
            'Zmieniono hasło użytkownika na nowe.'
        );
    }

    public function changeRole(FormRequest $request, User $user): object
    {
        $this->employeeService->checkRoleAndChange($request, $user);

        return back()->with(
            'message',
            'Zmieniono rolę użytkownika.'
        );
    }

    public function deleteAvatar(User $user): object
    {
        $this->employeeService->checkAndDeleteAvatar($user);

        return back()->with(
            'message',
            'Usunięto zdjęcie profilowe.'
        );
    }
}
