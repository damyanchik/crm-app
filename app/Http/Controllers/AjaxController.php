<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Client;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function searchUsers(Request $request): object
    {
        $searchTerm = $request->input('searchTerm');

        $users = $this->searchItems(
            User::query(),
            $searchTerm,
            ['name', 'surname', 'email']
        );

        return response()->json([
            'users' => $users
        ]);
    }

    public function searchClients(Request $request): object
    {
        $searchTerm = $request->input('searchTerm');

        $clients = $this->searchItems(
            Client::query(),
            $searchTerm,
            ['name', 'surname', 'company', 'tax', 'email']
        );

        return response()->json([
            'clients' => $clients
        ]);
    }

    public function searchBrands(Request $request): object
    {
        $searchTerm = $request->input('searchTerm');

        $brands = $this->searchItems(
            Brand::query(),
            $searchTerm,
            ['name']
        );

        return response()->json([
            'brands' => $brands
        ]);
    }

    public function searchProductCategories(Request $request): object
    {
        $searchTerm = $request->input('searchTerm');

        $productCategories = $this->searchItems(
            ProductCategory::query(),
            $searchTerm,
            ['name']
        );

        return response()->json([
            'productCategories' => $productCategories
        ]);
    }

    public function searchProducts(Request $request): object
    {
        $searchTerm = $request->input('searchTerm');

        $products = Product::with('brand')
            ->where('name', 'like', "%$searchTerm%")
            ->orWhere('code', 'like', "%$searchTerm%")
            ->orWhereHas('brand', function ($brandQuery) use ($searchTerm) {
                $brandQuery->where('name', 'like', "%$searchTerm%");
            })
            ->get();

        return response()->json([
            'products' => $products
        ]);
    }

    private function searchItems(object $query, string $searchTerm, array $columns): object
    {
        $items = $query;

        foreach ($columns as $column) {
            $items->orWhere($column, 'like', "%$searchTerm%");
        }

        return $items->get();
    }
}
