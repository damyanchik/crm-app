<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\PhotoHelper;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
    }

    public function index(): object
    {
        return view('products.index', [
            'products' => $this->productService->getProducts()
        ]);
    }

    public function create(): object
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request): object
    {
        try {
            $this->productService->validateAndStoreProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Nastąpił błąd w trakcie tworzenia produktu!');
        }
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
        try {
            $this->productService->validateAndUpdateProduct($request, $product);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Nastąpił błąd w trakcie aktualizacji produktu!');
        }

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
        $this->productService->destroyPhoto($product);

        return back()->with(
            'message',
            'Usunięto zdjęcie produktu.'
        );
    }
}
