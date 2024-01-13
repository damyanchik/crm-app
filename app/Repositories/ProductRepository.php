<?php

namespace App\Repositories;

use App\Helpers\PhotoHelper;
use App\Models\Product;
use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends BaseRepository
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

    public function updateMany(array $data): void
    {
        Product::updateMany($data, 'code');
    }
}
