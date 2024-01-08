<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\IndexRequest;
use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;

class ClientService
{
    public function __construct(protected SearchService $searchService)
    {
    }

    public function getAll(IndexRequest $indexRequest): object
    {
        return $this->searchService->searchItems(new Client(), $indexRequest);
    }

    public function store(array $validatedData): void
    {
        Client::create($validatedData);
    }

    public function update(Client $client, array $validatedData): void
    {
        $formFields = $validatedData;
        $formFields['user_id'] = $formFields['user_id'] ?? null;

        $client->update($formFields);
    }

    public function destroy(Client $client): void
    {
        $client->delete();
    }
}
