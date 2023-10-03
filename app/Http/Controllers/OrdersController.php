<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrdersController extends Controller
{
    public function index()
    {
        return view('orders.index', [

        ]);
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {

        $formFields = $request->validate([
            'user_id' => 'required',
            'status' => 'required',
            'invoice_num' => 'nullable',
            'total_quantity' => 'nullable',
            'total_price' => 'nullable',
            'products.*.name' => 'required',
            'products.*.brand' => 'required',
            'products.*.unit' => 'required',
            'products.*.quantity' => 'required',
            'products.*.price' => 'required'
        ]);

        dd($formFields);

//        Order::create($formFields);
//
//        return redirect('/clients')->with('message', 'Klient został założony.');
    }
}
