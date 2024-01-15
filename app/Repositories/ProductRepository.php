<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Helpers\PhotoHelper;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Traits\SearchableTrait;
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
        PhotoHelper::deletePreviousPhoto($currentModel->photo);
        parent::destroy($currentModel);
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
