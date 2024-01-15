<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\CompanyInfo;

interface CompanyRepositoryInterface
{
    public function __construct(CompanyInfo $model);
}
