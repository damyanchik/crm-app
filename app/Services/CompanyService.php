<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CompanyInfo;

class CompanyService
{
    public function getAll(): object
    {
        return CompanyInfo::all()->first();
    }

    public function update(array $formFields): void
    {
        CompanyInfo::updateOrCreate(
            ['id' => 1],
            $formFields
        );
    }
}
