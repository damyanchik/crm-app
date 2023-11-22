<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    public function index(): object
    {
        $brands = Brand::where(
            'name',
            'like',
            '%' . request('search') . '%'
        )->orderBy(
            request('column') ?? 'id',
            request('order') ?? 'asc'
        )->paginate(
            request('display')
        );

        return view('products.brands.index', [
            'brands' => $brands
        ]);
    }

    public function create(): object
    {
        return view('products.brands.create');
    }

    public function store(Request $request): object
    {
        $formFields = $request->validate([
            'name' => 'required'
        ]);

        Brand::create($formFields);

        return redirect('/brands')->with(
            'message', 'Marka została utworzona.'
        );
    }

    public function edit(Brand $brand): object
    {
        return view('products.brands.edit', [
            'brand' => $brand
        ]);
    }

    public function update(Request $request, Brand $brand): object
    {
        $formFields = $request->validate([
            'name' => 'required'
        ]);

        $brand->update($formFields);

        return back()->with(
            'message', 'Marka została edytowana.'
        );
    }

    public function destroy(Brand $brand): object
    {
        $brand->delete();

        return redirect('/brands')->with(
            'message', 'Marka została usunięta.'
        );
    }
}
