<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ClientRepositoryInterface
{
    public function update(Model|int $client, array $data): void;
}
