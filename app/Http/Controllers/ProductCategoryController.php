<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\Http\Requests\StoreCategoryProductRequest;
use App\Http\Requests\UpdateCategoryProductRequest;
use App\Models\ProductCategory;
use App\Services\ProductCategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductCategoryController extends Controller
{
    public function __construct(protected ProductCategoryService $categoryService)
    {
    }

    public function index(IndexRequest $indexRequest): View
    {
        return view('products.product_categories.index', [
            'productCategories' => $this->categoryService->getAll($indexRequest->getSearchParams())
        ]);
    }

    public function create(): View
    {
        return view('products.product_categories.create');
    }

    public function store(StoreCategoryProductRequest $request): RedirectResponse
    {
        try {
            $this->categoryService->store($request->validated());
            return redirect()
                ->route('prodCats')
                ->with('message', 'Kategoria produktowa została utworzona.');
        } catch (\Exception $e) {
            return back()
                ->with('message', 'Nastąpił błąd w trakcie zapisu.');
        }
    }

    public function edit(ProductCategory $productCategory): View
    {
        return view('products.product_categories.edit', [
            'productCategory' => $productCategory
        ]);
    }

    public function update(ProductCategory $productCategory, UpdateCategoryProductRequest $request): RedirectResponse
    {
        try {
            $this->categoryService->update($productCategory, $request->validated());
            return back()
                ->with('message', 'Kategoria produktowa została edytowana.');
        } catch (\Exception $e) {
            return back()
                ->with('message', 'Nastąpił błąd w trakcie zapisu.');
        }
    }

    public function destroy(ProductCategory $productCategory): RedirectResponse
    {
        try {
            $this->categoryService->destroy($productCategory);
            return redirect()
                ->route('prodCats')
                ->with('message', 'Kategoria produktowa została usunięta.');
        } catch (\Exception $e) {
            return back()
                ->with('message', 'Nastąpił błąd w trakcie zapisu.');
        }
    }
}
