<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\CompanyInfo;
use App\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{
    public function __construct(CompanyInfo $model)
    {
        parent::__construct($model);
    }
}
