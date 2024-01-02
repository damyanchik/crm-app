<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Client;

class ClientService
{
    public function getAll(): object
    {
        return Client::search(request('search'))
            ->sortBy(
                request('column') ?? 'id',
                request('order') ?? 'asc'
            )->paginate(request('display'));
    }

    public function store(array $formFields): void
    {
        Client::create($formFields);
    }

    public function update(Client $client, array $formFields): void
    {
        $formFields['user_id'] = $formFields['user_id'] ?? null;
        $client->update($formFields);
    }

    public function destroy(Client $client): void
    {
        $client->delete();
    }
}
