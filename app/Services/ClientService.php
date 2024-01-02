<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;

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

    public function store(FormRequest $request): void
    {
        Client::create($request->validated());
    }

    public function update(Client $client, FormRequest $request): void
    {
        $formFields = $request->validated();
        $formFields['user_id'] = $formFields['user_id'] ?? null;

        $client->update($formFields);
    }

    public function destroy(Client $client): void
    {
        $client->delete();
    }
}
