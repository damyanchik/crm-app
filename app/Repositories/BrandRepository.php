<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Brand;
use App\Traits\SearchableTrait;

class BrandRepository extends BaseRepository
{
    use SearchableTrait;

    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }
}
