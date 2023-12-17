<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\CSVHelper;
use App\Helpers\PhotoHelper;
use App\Models\Product;
use App\Patterns\AbstractFactories\FileDataImporter\Factories\ProductAdditionFactory;
use App\Patterns\AbstractFactories\FileDataImporter\Factories\ProductUpdateFactory;
use App\Patterns\AbstractFactories\FileDataImporter\FileDataImporter;
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

    public function validateAndImportNewProduct(FormRequest $request): void
    {
        $csvData = CSVHelper::validateFileAndReadToArray($request, [
            'name', 'code', 'quantity', 'unit', 'price', 'brand_id', 'category_id'
        ]);

        $fileImportProcessor = new FileDataImporter(new ProductAdditionFactory());
        $fileImportProcessor->processData($csvData);

        Product::insert($fileImportProcessor->processData($csvData));
    }

    public function validateAndImportUpdateProduct(FormRequest $request): void
    {
        $csvData = CSVHelper::validateFileAndReadToArray($request, [
            'code', 'quantity', 'price'
        ]);

        $fileImportProcessor = new FileDataImporter(new ProductUpdateFactory());

        Product::updateMany($fileImportProcessor->processData($csvData), 'code');
    }
}
