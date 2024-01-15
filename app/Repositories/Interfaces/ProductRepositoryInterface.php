<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

interface ProductRepositoryInterface
{
    public function __construct(Product $model);
    public function destroy(Model|int $product): void;
    public function destroyPhoto(Product $product): void;
    public function storeMany(array $data): void;
    public function getStock(array $codes): array;
    public function updateMany(array $data): void;
    public function searchToAjax(string $searchTerm): object;
}
