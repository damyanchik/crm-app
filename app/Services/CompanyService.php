<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CompanyInfo;
use Illuminate\Foundation\Http\FormRequest;

class CompanyService
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
