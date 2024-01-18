<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings', []);
    }
}
