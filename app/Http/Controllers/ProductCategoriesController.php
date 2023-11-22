<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    public function index(): object
    {
        $productCategories = ProductCategory::where(
            'name', 'like', '%' . request('search') . '%'
        )->orderBy(
            request('column') ?? 'id',
            request('order') ?? 'ASC'
        )->paginate(request('display'));

        return view('products.product_categories.index', [
            'productCategories' => $productCategories
        ]);
    }

    public function create(): object
    {
        return view('products.product_categories.create');
    }

    public function store(Request $request): object
    {
        $formFields = $request->validate([
            'name' => 'required'
        ]);

        ProductCategory::create($formFields);

        return redirect('/product-categories')->with(
            'message',
            'Kategoria produktowa została utworzona.'
        );
    }

    public function edit(ProductCategory $productCategory): object
    {
        return view('products.product_categories.edit', [
            'productCategory' => $productCategory
            ]);
    }

    public function update(Request $request, ProductCategory $productCategory): object
    {
        $formFields = $request->validate([
            'name' => 'required'
        ]);

        $productCategory->update($formFields);

        return back()->with(
            'message',
            'Kategoria produktowa została edytowana.'
        );
    }


    public function destroy(ProductCategory $productCategory): object
    {
        $productCategory->delete();

        return redirect('/product-categories')->with(
            'message',
            'Kategoria została usunięta.'
        );
    }
}
