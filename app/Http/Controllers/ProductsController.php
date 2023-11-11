<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductsController extends Controller
{
    public function index(): object
    {
        $products = Product::search(request('search'))->paginate(request('display'));

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

    public function edit(Product $product): object
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product): object
    {
        $formFields = $request->validated();

        $product->update($formFields);

        return back()->with('message', 'Produkt został zaktualizowany.');
    }

    public function destroy(Product $product): object
    {
        $product->delete();

        return redirect('/products')->with('message', 'Produkt został usunięty.');
    }
}
