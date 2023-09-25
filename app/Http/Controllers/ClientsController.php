<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Validation\Rule;

class ClientsController extends Controller
{
    public function index()
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

    public function show(Client $client)
    {
        return view('clients.show', [
            'client' => $client,
        ]);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'company' => ['required', Rule::unique('client', 'company')],
            'name' => 'required',
            'surname' => 'required',
            'email' => ['required', 'email'],
            'phone' => 'required',
            'address' => 'nullable',
            'postal_code' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'note'=> 'nullable',
            'tax' => 'required'
        ]);

        Client::create($formFields);

        return redirect('/clients')->with('message', 'Klient został założony.');
    }

    public function update(Request $request, Client $client)
    {
        $formFields = $request->validate([
            'company' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'email' => ['required', 'email'],
            'phone' => 'required',
            'address' => 'nullable',
            'postal_code' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'tax' => 'required'
        ]);

        $client->update($formFields);

        return back()->with('message', 'Klient został zaktualizowany.');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', [
            'client' => $client,
        ]);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect('/clients')->with('message', 'Klient został usunięty.');
    }
}
