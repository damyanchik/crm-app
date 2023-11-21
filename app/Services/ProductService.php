<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;

class ProductService
{
    public function createProduct(StoreProductRequest $request): void
    {
        $formFields = $request->validated();

        if ($request->hasFile('photo')) {
            $this->validateAndStorePhoto($request, $formFields);
        }

        Product::create($formFields);
    }

    public function updateProduct(Product $product, UpdateProductRequest $request): void
    {
        $validatedData = $request->validated();

        if ($request->hasFile('photo')) {
            $this->validateAndUpdatePhoto($product, $request, $validatedData);
        }

        $product->update($validatedData);
    }

    public function deletePreviousPhoto($photoPath): void
    {
        $previousPhotoPath = 'public/' . $photoPath;

        if (Storage::disk('local')->exists($previousPhotoPath)) {
            Storage::disk('local')->delete($previousPhotoPath);
        }
    }

    private function validateAndStorePhoto(StoreProductRequest $request, &$formFields): void
    {
        $request->validate([
            'photo' => 'image|max:5120|dimensions:min_width=200,min_height=200,max_width=800,max_height=800',
        ]);

        $formFields['photo'] = $request->file('photo')->store('images/product_photo', 'public');
    }

    private function validateAndUpdatePhoto(Product $product, UpdateProductRequest $request, &$validatedData): void
    {
        $request->validate([
            'photo' => 'image|max:5120|dimensions:min_width=200,min_height=200,max_width=800,max_height=800',
        ]);

        if ($product->photo) {
            $this->deletePreviousPhoto($product->photo);
        }

        $validatedData['photo'] = $request->file('photo')->store('images/product_photo', 'public');
    }
}
