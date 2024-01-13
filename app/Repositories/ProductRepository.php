<?php

namespace App\Repositories;

use App\Helpers\PhotoHelper;
use App\Models\Product;
use App\Traits\SearchableTrait;

class ProductRepository
{
    use SearchableTrait;

    public function store(array $validatedData): void
    {
        Product::create($validatedData);
    }

    public function update(array $validatedData, Product $product): void
    {
        $product->update($validatedData);
    }

    public function destroy(Product $product): void
    {
        PhotoHelper::deletePreviousPhoto($product->photo);
        $product->delete();
    }

    public function destroyPhoto(Product $product): void
    {
        PhotoHelper::deletePreviousPhoto($product->photo);

        $product->setAttribute('photo', null);
        $product->save();
    }

    public function storeMany(array $data): void
    {
        Product::insert($data);
    }

    public function updateMany(array $data): void
    {
        Product::updateMany($data, 'code');
    }

    public function searchProducts(string $searchTerm): object
    {
        return Product::with('brand')
            ->where('name', 'like', "%$searchTerm%")
            ->orWhere('code', 'like', "%$searchTerm%")
            ->orWhereHas('brand', function ($brandQuery) use ($searchTerm) {
                $brandQuery->where('name', 'like', "%$searchTerm%");
            })
            ->get();
    }
}
