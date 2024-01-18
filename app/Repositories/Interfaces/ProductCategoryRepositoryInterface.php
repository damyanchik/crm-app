<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\ProductCategory;

interface ProductCategoryRepositoryInterface
{
    public function __construct(ProductCategory $model);
    public function storeOrIgnoreMany(array $data): void;
}
