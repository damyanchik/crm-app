<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Services\ProductCategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductCategoryController extends Controller
{
    public function __construct(protected ProductCategoryService $categoryService)
    {
    }

    public function index(): View
    {
        return view('products.product_categories.index', [
            'productCategories' => $this->categoryService->getAll()
        ]);
    }

    public function create(): View
    {
        return view('products.product_categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $this->categoryService->store($request->validate(['name' => 'unique:product_categories,name']));
            return redirect()->route('prodCats')->with('message', 'Kategoria produktowa została utworzona.');
        } catch (\Exception $e) {
            return back()->with('message', 'Nastąpił błąd w trakcie zapisu.');
        }
    }

    public function edit(ProductCategory $productCategory): View
    {
        return view('products.product_categories.edit', [
            'productCategory' => $productCategory
        ]);
    }

    public function update(Request $request, ProductCategory $productCategory): RedirectResponse
    {
        try {
            $this->categoryService->update($productCategory, $request->validate(['name' => 'required']));
            return back()->with('message', 'Kategoria produktowa została edytowana.');
        } catch (\Exception $e) {
            return back()->with('message', 'Nastąpił błąd w trakcie zapisu.');
        }
    }


    public function destroy(ProductCategory $productCategory): RedirectResponse
    {
        try {
            $this->categoryService->destroy($productCategory);
            return redirect()->route('prodCats')->with('message', 'Kategoria produktowa została usunięta.');
        } catch (\Exception $e) {
            return back()->with('message', 'Nastąpił błąd w trakcie zapisu.');
        }
    }
}
