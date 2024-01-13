<?php

namespace App\Repositories;

use App\Models\CompanyInfo;

class CompanyRepository
{
    public function getAll(): object
    {
        return CompanyInfo::all()->first();
    }

    public function update(array $validateData): void
    {
        CompanyInfo::updateOrCreate(
            ['id' => 1],
            $validateData
        );
    }
}
