<?php

namespace App\Repositories;

use App\Models\Client;
use App\Traits\SearchableTrait;

class ClientRepository
{
    use SearchableTrait;

    public function getAll(array $searchParams): object
    {
        return $this->searchAndSort(new Client(), $searchParams);
    }

    public function store(array $validatedData): void
    {
        Client::create($validatedData);
    }

    public function update(Client $client, array $validatedData): void
    {
        $validatedData['user_id'] = $validatedData['user_id'] ?? null;

        $client->update($validatedData);
    }

    public function destroy(Client $client): void
    {
        $client->delete();
    }
}
