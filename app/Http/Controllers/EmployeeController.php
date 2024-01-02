<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\User;
use App\Services\EmployeeService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    public function __construct(protected EmployeeService $employeeService)
    {
    }

    public function index(): View
    {
        return view('employees.index', [
            'users' => $this->employeeService->getAll()
        ]);
    }

    public function show(User $user): View
    {
        return view('employees.show', [
            'user' => $user,
        ]);
    }

    public function block(User $user): RedirectResponse
    {
        $this->employeeService->checkAndSetBlock($user);

        return back()->with('message', 'Zmiana statusu użytkownika!');
    }

    public function edit(User $user): View
    {
        return view('employees.edit', [
            'user' => $user,
            'roles' => Role::get()
        ]);
    }

    public function update(UpdateEmployeeRequest $request, User $user): RedirectResponse
    {
        try {
            $this->employeeService->validateAndUpdate($request, $user);
            return back()->with('message', 'Użytkownik zaktualizowany!');
        } catch (\Exception $e) {
            return back()->with('error', 'Nastąpił błąd w trakcie dodawania nowych produktów!');
        }
    }

    public function changePassword(FormRequest $request, User $user): RedirectResponse
    {
        $this->employeeService->validateAndChangePassword($request, $user);

        return back()->with('message', 'Zmieniono hasło użytkownika na nowe.');
    }

    public function changeRole(FormRequest $request, User $user): RedirectResponse
    {
        $this->employeeService->checkRoleAndChange($request, $user);

        return back()->with('message', 'Zmieniono rolę użytkownika.');
    }

    public function deleteAvatar(User $user): RedirectResponse
    {
        $this->employeeService->checkAndDeleteAvatar($user);

        return back()->with('message', 'Usunięto zdjęcie profilowe.');
    }

    public function create(): View
    {
        return view('admin.create_user');
    }

    public function store(StoreEmployeeRequest $employeeRequest): RedirectResponse
    {
        try {
            $this->employeeService->store($employeeRequest->validated());
            return redirect()->route('storeEmployeeAdmin')->with('message', 'Nowy pracownik został założony.');
        } catch (\Exception $e) {
            return back()->with('message', 'Nastąpił błąd w trakcie zapisu.');
        }
    }
}
