<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface ProductCategoryRepositoryInterface
{
    public function storeOrIgnoreMany(array $data): void;
}
