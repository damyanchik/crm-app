<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Client;
use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class ClientRepository extends BaseRepository
{
    use SearchableTrait;

    public function __construct(Client $model)
    {
        parent::__construct($model);
    }

    public function update(Model|int $client, array $data): void
    {
        $data['user_id'] = $data['user_id'] ?? null;

        parent::update($client, $data);
    }
}
