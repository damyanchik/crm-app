<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Client;
use App\Repositories\ClientRepository;

class ClientService
{
    public function __construct(protected ClientRepository $clientRepository)
    {
    }

    public function getAll(array $searchParams): object
    {
        return $this->clientRepository->searchAndSort($searchParams);
    }

    public function store(array $validatedData): void
    {
        $this->clientRepository->store($validatedData);
    }

    public function update(Client $client, array $validatedData): void
    {
        $this->clientRepository->update($client, $validatedData);
    }

    public function destroy(Client $client): void
    {
        $this->clientRepository->destroy($client);
    }

    public function handleAjax(string $searchTerm): object
    {
        return $this->clientRepository->searchWhereItems(
            $searchTerm,
            ['name', 'surname', 'company', 'tax', 'email']
        );
    }
}
