<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function __construct(protected ClientService $clientService)
    {
    }

    public function index(IndexRequest $indexRequest): View
    {
        return view('clients.index', [
            'clients' => $this->clientService->getAll($indexRequest->getSearchParams())
        ]);
    }

    public function show(Client $client): View
    {
        return view('clients.show', [
            'client' => $client,
        ]);
    }

    public function create(): View
    {
        return view('clients.create');
    }

    public function store(StoreClientRequest $request): RedirectResponse
    {
        try {
            $this->clientService->store($request->validated());
            return redirect()->route('clients')->with('message', 'Klient został założony.');
        } catch (\Exception $e) {
            return back()->with('message', 'Nastąpił błąd w trakcie zapisu.');
        }
    }

    public function update(UpdateClientRequest $request, Client $client): RedirectResponse
    {
        try {
            $this->clientService->update($client, $request->validated());
            return redirect()->route('clients')->with('message', 'Klient został zaktualizowany.');
        } catch (\Exception $e) {
            return back()->with('message', 'Nastąpił błąd w trakcie zapisu.');
        }
    }

    public function edit(Client $client): View
    {
        return view('clients.edit', [
            'client' => $client,
        ]);
    }

    public function destroy(Client $client): RedirectResponse
    {
        try {
            $this->clientService->destroy($client);
            return redirect()->route('clients')->with('message', 'Klient został usunięty.');
        } catch (\Exception $e) {
            return back()->with('message', 'Nastąpił błąd w trakcie usuwania.');
        }
    }
}
