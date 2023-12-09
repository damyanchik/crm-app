<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\User;
use App\Services\EmployeeService;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class EmployeesController extends Controller
{
    private EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index(): object
    {
        $users = User::search(request('search'))
            ->sortBy(
                request('column') ?? 'id',
                request('order') ?? 'asc'
            )->paginate(request('display'));

        return view('employees.index', [
            'users' => $users
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
        $this->employeeService->validateAndUpdateEmployee($request, $user);

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
