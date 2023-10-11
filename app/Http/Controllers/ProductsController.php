<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class ProductsController extends Controller
{
    public function index()
    {
        return view('products.index', [

        ]);
    }

    public function show()
    {

    }

    public function create()
    {
        return view('products.create', [

        ]);
    }

    public function store()
    {

    }
}
