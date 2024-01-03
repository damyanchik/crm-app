<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\CSVHelper;
use App\Helpers\PhotoHelper;
use App\Http\Requests\IndexRequest;
use App\Models\Product;
use App\Patterns\AbstractFactories\FileDataImporter\Factories\ProductAdditionFactory;
use App\Patterns\AbstractFactories\FileDataImporter\Factories\ProductUpdateFactory;
use App\Patterns\AbstractFactories\FileDataImporter\FileDataImporter;
use Illuminate\Foundation\Http\FormRequest;

class ProductService
{
    public function __construct(protected FileDataImporter $fileDataImporter, protected SearchService $searchService)
    {
    }

    public function getAll(IndexRequest $indexRequest): object
    {
        return $this->searchService->searchItems(new Product(), $indexRequest);
    }

    public function store(FormRequest $request): void
    {
        $validatedData = $request->validated();

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $request->file('photo')->store('images/product_photo', 'public');
        }

        Product::create($validatedData);
    }

    public function update(FormRequest $request, Product $product): void
    {
        $validatedData = $request->validated();

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            if ($product->photo)
                PhotoHelper::deletePreviousPhoto($product->photo);
            $validatedData['photo'] = $request->file('photo')->store('images/product_photo', 'public');
        }

        $product->update($validatedData);
    }

    public function importNewProduct(FormRequest $request): void
    {
        $csvData = CSVHelper::validateFileAndReadToArray($request, [
            'name', 'code', 'quantity', 'unit', 'price', 'brand_id', 'category_id'
        ]);

        $this->fileDataImporter->setFactory(new ProductAdditionFactory());

        Product::insert($this->fileDataImporter->processData($csvData));
    }

    public function importProductToUpdate(FormRequest $request): void
    {
        $csvData = CSVHelper::validateFileAndReadToArray($request, [
            'code', 'quantity', 'price'
        ]);

        $this->fileDataImporter->setFactory(new ProductUpdateFactory());

        Product::updateMany($this->fileDataImporter->processData($csvData), 'code');
    }

    public function destroyPhoto(Product $product): void
    {
        PhotoHelper::deletePreviousPhoto($product->photo);

        $product->setAttribute('photo', null);
        $product->save();
    }

    public function destroy(Product $product): void
    {
        PhotoHelper::deletePreviousPhoto($product->photo);
        $product->delete();
    }
}
