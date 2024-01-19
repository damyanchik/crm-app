<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Helpers\PhotoHelper;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    use SearchableTrait;

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function destroy(Model|int $product): void
    {
        $currentModel = $this->checkModelOrInt($product);

        if (!empty($currentModel->photo)) {
            PhotoHelper::deletePreviousPhoto($currentModel->photo);
        }

        parent::destroy($currentModel);
    }

    public function destroyPhoto(Product $product): void
    {
        if (!empty($product->photo)) {
            PhotoHelper::deletePreviousPhoto($product->photo);
        }

        $product->setAttribute('photo', null);
        $product->save();
    }

    public function getExistingCodes(array $data): array
    {
        return Product::getExistingByCodes($data);
    }

    public function getExistingProductsUsingData(array $data): array
    {
        $codes = array_column($data, 'code');

        return Product::whereIn('code', $codes)
            ->with('brand')
            ->select('name', 'code', 'quantity', 'price', 'unit', 'brand_id')
            ->get()
            ->map(function ($product) {
                $productArray = $product->toArray();

                return [
                        'name' => $productArray['name'],
                        'code' => $productArray['code'],
                        'quantity' => $productArray['quantity'],
                        'price' => $productArray['price'],
                        'unit' => $productArray['unit'],
                        'brand' => $product->brand->name ?? '',
                    ] + $productArray;
            })
            ->keyBy('code')
            ->toArray();
    }

    public function storeMany(array $data): void
    {
        Product::insert($data);
    }

    public function getStock(array $codes): array
    {
        return Product::whereIn('code', $codes)
            ->pluck('quantity', 'code')
            ->toArray();
    }

    public function updateMany(array $data): void
    {
        Product::updateMany($data, 'code');
    }

    public function searchToAjax(string $searchTerm): object
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
