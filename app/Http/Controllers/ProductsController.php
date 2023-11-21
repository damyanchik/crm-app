<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Support\Facades\App;

class ProductsController extends Controller
{
    public function index(): object
    {
        $products = Product::search(request('search'))
            ->orderBy(
                request('column') ?? 'id',
                request('order') ?? 'asc'
            )
            ->paginate(request('display'));

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
        $productService = App::make(ProductService::class);
        $productService->createProduct($request);

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
        $productService = App::make(ProductService::class);
        $productService->updateProduct($product, $request);

        return back()->with('message', 'Produkt został zaktualizowany.');
    }

    public function destroy(Product $product): object
    {
        $product->delete();

        return redirect('/products')->with('message', 'Produkt został usunięty.');
    }

    public function deleteProductPhoto(Product $product): object
    {
        $productService = App::make(ProductService::class);
        $productService->deletePreviousPhoto($product->photo);

        $product->setAttribute('photo', null);
        $product->save();

        return back()->with('message', 'Usunięto zdjęcie produktu.');
    }
}
