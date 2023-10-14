<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Client;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function searchUsers(Request $request): object
    {
        $searchTerm = $request->input('searchTerm');

        $users = User::where('name', 'like', "%$searchTerm%")
            ->orWhere('surname', 'like', "%$searchTerm%")
            ->orWhere('email', 'like', "%$searchTerm%")
            ->get();

        return response()->json([
            'users' => $users
        ]);
    }

    public function searchClients(Request $request): object
    {
        $searchTerm = $request->input('searchTerm');

        $clients = Client::where('name', 'like', "%$searchTerm%")
            ->orWhere('surname', 'like', "%$searchTerm%")
            ->orWhere('company', 'like', "%$searchTerm%")
            ->orWhere('tax', 'like', "%$searchTerm%")
            ->orWhere('email', 'like', "%$searchTerm%")
            ->get();

        return response()->json([
            'clients' => $clients
        ]);
    }

    public function searchBrands(Request $request): object
    {
        $searchTerm = $request->input('searchTerm');

        $brands = Brand::where('name', 'like', "%$searchTerm%")
            ->get();

        return response()->json([
            'brands' => $brands
        ]);
    }

    public function searchProductCategories(Request $request): object
    {
        $searchTerm = $request->input('searchTerm');

        $productCategories = ProductCategory::where('name', 'like', "%$searchTerm%")
            ->get();

        return response()->json([
            'productCategories' => $productCategories
        ]);
    }
}
