<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface BrandRepositoryInterface
{
    public function storeOrIgnoreMany(array $data): void;
}
