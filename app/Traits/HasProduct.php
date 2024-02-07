<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasProduct
{
    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
