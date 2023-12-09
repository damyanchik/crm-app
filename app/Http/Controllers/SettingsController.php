<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings', [

        ]);
    }
}
