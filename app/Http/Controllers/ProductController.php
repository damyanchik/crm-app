<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\PhotoHelper;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
    }

    public function index(): View
    {
        return view('products.index', [
            'products' => $this->productService->getProducts()
        ]);
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->productService->store($request);
            DB::commit();
            return redirect()->route('products')->with('message', 'Produkt został utworzony.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Nastąpił błąd w trakcie tworzenia produktu!');
        }
    }

    public function edit(Product $product): View
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->productService->update($request, $product);
            DB::commit();
            return back()->with('message', 'Produkt został zaktualizowany.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Nastąpił błąd w trakcie aktualizacji produktu!');
        }
    }

    public function destroy(Product $product): RedirectResponse
    {
        try {
            $this->productService->destroy($product);
            return redirect()->route('products')->with('message', 'Produkt został usunięty.');
        } catch (\Exception $e) {
            return back()->with('message', 'Nastąpił błąd w trakcie usuwania produktu.');
        }
    }

    public function deletePhoto(Product $product): RedirectResponse
    {
        try {
            $this->productService->destroyPhoto($product);
            return back()->with('message', 'Usunięto zdjęcie produktu.');
        } catch (\Exception $e) {
            return back()->with('message', 'Nastąpił błąd w trakcie usuwania zdjęcia.');
        }
    }
}
