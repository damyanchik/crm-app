<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Brand;
use App\Models\Client;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;

class AjaxService
{
    public function getUsers(string $searchTerm): object
    {
        return $this->searchItems(
            User::query(),
            $searchTerm,
            ['name', 'surname', 'email']
        );
    }

    public function getClients(string $searchTerm): object
    {
        return $this->searchItems(
            Client::query(),
            $searchTerm,
            ['name', 'surname', 'company', 'tax', 'email']
        );
    }

    public function getBrands(string $searchTerm): object
    {
        return $this->searchItems(
            Brand::query(),
            $searchTerm,
            ['name']
        );
    }

    public function getProductCategories(string $searchTerm): object
    {
        return $this->searchItems(
            ProductCategory::query(),
            $searchTerm,
            ['name']
        );
    }

    public function getProducts(string $searchTerm): object
    {
        return Product::with('brand')
            ->where('name', 'like', "%$searchTerm%")
            ->orWhere('code', 'like', "%$searchTerm%")
            ->orWhereHas('brand', function ($brandQuery) use ($searchTerm) {
                $brandQuery->where('name', 'like', "%$searchTerm%");
            })
            ->get();
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
