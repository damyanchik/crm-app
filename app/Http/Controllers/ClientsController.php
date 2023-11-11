<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;

class ClientsController extends Controller
{
    public function index(): object
    {
        $clients = Client::search(request('search'))->paginate(request('display'));

        return view('clients.index', [
            'clients' => $clients
        ]);
    }

    public function show(Client $client): object
    {
        return view('clients.show', [
            'client' => $client,
        ]);
    }

    public function create(): object
    {
        return view('clients.create');
    }

    public function store(StoreClientRequest $request): object
    {
        $formFields = $request->validated();

        Client::create($formFields);

        return redirect('/clients')->with('message', 'Klient został założony.');
    }

    public function update(UpdateClientRequest $request, Client $client): object
    {
        $formFields = $request->validated();

        if (empty($formFields['user_id']))
            $formFields['user_id'] = null;

        $client->update($formFields);

        return back()->with('message', 'Klient został zaktualizowany.');
    }

    public function edit(Client $client): object
    {
        return view('clients.edit', [
            'client' => $client,
        ]);
    }

    public function destroy(Client $client): object
    {
        $client->delete();

        return redirect('/clients')->with('message', 'Klient został usunięty.');
    }
}
