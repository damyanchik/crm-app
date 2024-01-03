<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Product;

trait HasProduct
{
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
