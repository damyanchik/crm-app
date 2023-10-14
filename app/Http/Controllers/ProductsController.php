<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;

class ProductsController extends Controller
{
    public function index(): object
    {
        $products = Product::where(
            'name', 'like', '%' . request('search') . '%'
        )->paginate(request('display'));

        return view('products.index', [
            'products' => $products
        ]);
    }

    public function create(): object
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request): object
    {
        $formFields = $request->validated();

        Product::create($formFields);

        return redirect('/products')->with('message', 'Produkt został utworzony.');
    }
}
