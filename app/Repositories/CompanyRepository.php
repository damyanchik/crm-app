<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\CompanyInfo;

class CompanyRepository extends BaseRepository
{
    public function __construct(CompanyInfo $model)
    {
        parent::__construct($model);
    }
}
