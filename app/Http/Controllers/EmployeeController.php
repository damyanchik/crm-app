<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function create(): object
    {
        return view('admin.create_user');
    }

    public function store(StoreEmployeeRequest $employeeRequest): object
    {
        $formFields = $employeeRequest->validated();

        $formFields['password'] = Hash::make($formFields['password']);

        User::create($formFields);

        return redirect('/employees')->with(
            'message',
            'Nowy pracownik został założony.'
        );
    }
}
