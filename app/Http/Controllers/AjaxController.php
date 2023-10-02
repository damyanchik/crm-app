<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $users = User::where('name', 'like', "%$searchTerm%")
            ->orWhere('surname', 'like', "%$searchTerm%")
            ->orWhere('email', 'like', "%$searchTerm%")
            ->get();

        return response()->json(['users' => $users]);
    }
}
