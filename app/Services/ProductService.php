<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\PhotoHelper;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductService
{
    public function validateAndStoreProduct(FormRequest $request): void
    {
        $validatedData = $request->validated();

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $request->file('photo')->store('images/product_photo', 'public');
        }

        Product::create($validatedData);
    }

    public function validateAndUpdateProduct(FormRequest $request, Product $product): void
    {
        $validatedData = $request->validated();

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            if ($product->photo)
                PhotoHelper::deletePreviousPhoto($product->photo);
            $validatedData['photo'] = $request->file('photo')->store('images/product_photo', 'public');
        }

        $product->update($validatedData);
    }
}
