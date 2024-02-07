<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\CompanyRepository;

class CompanyService
{
    public function __construct(protected CompanyRepository $companyRepository)
    {
    }

    public function getAll(): object
    {
        return $this->companyRepository->getAll();
    }

    public function update(array $validateData): void
    {
        $this->companyRepository->update(1, $validateData);
    }
}
