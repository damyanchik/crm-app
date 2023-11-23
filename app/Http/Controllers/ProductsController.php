<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\PhotoHelper;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;

class ProductsController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): object
    {
        $products = Product::search(request('search'))
            ->orderBy(
                request('column') ?? 'id',
                request('order') ?? 'ASC'
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
        $this->productService->validateAndStoreProduct($request);

        return redirect('/products')->with(
            'message',
            'Produkt został utworzony.'
        );
    }

    public function edit(Product $product): object
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product): object
    {
        $this->productService->validateAndUpdateProduct($request, $product);

        return back()->with(
            'message',
            'Produkt został zaktualizowany.'
        );
    }

    public function destroy(Product $product): object
    {
        $product->delete();

        return redirect('/products')->with(
            'message',
            'Produkt został usunięty.'
        );
    }

    public function deletePhoto(Product $product): object
    {
        PhotoHelper::deletePreviousPhoto($product->photo);

        $product->setAttribute('photo', null);
        $product->save();

        return back()->with(
            'message',
            'Usunięto zdjęcie produktu.'
        );
    }
}
