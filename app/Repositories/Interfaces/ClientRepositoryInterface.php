<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

interface ClientRepositoryInterface
{
    public function __construct(Client $model);
    public function update(Model|int $client, array $data): void;
}
