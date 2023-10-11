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
        $clients = Client::where(function($query) {
            $query->orWhere('company', 'like', '%' . request('search') . '%')
                ->orWhere('name', 'like', '%' . request('search') . '%')
                ->orWhere('surname', 'like', '%' . request('search') . '%')
                ->orWhere('email', 'like', '%' . request('search') . '%')
                ->orWhere('phone', 'like', '%' . request('search') . '%')
                ->orWhere('address', 'like', '%' . request('search') . '%')
                ->orWhere('postal_code', 'like', '%' . request('search') . '%')
                ->orWhere('city', 'like', '%' . request('search') . '%')
                ->orWhere('state', 'like', '%' . request('search') . '%')
                ->orWhere('country', 'like', '%' . request('search') . '%');
        })->paginate(request('display'));

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
