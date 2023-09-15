<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmployeesController extends Controller
{
    public function index()
    {
        return view('employees.index', [
            'users' => User::all()
        ]);
    }
}
