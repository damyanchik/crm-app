<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function __construct(protected BrandService $brandService)
    {
    }

    public function index(IndexRequest $indexRequest): View
    {
        return view('products.brands.index', [
            'brands' => $this->brandService->getAll($indexRequest->getSearchParams())
        ]);
    }

    public function create(): View
    {
        return view('products.brands.create');
    }

    public function store(StoreBrandRequest $request): RedirectResponse
    {
        try {
            $this->brandService->store($request->validated());
            return redirect()->route('brands')->with('message', 'Marka została utworzona.');
        } catch (\Exception $e) {
            return back()->with('message', 'Nastąpił błąd w trakcie zapisu.');
        }
    }

    public function edit(Brand $brand): View
    {
        return view('products.brands.edit', [
            'brand' => $brand
        ]);
    }

    public function update(UpdateBrandRequest $request, Brand $brand): RedirectResponse
    {
        try {
            $this->brandService->update($brand, $request->validated());
            return redirect()->route('brands')->with('message', 'Marka została edytowana.');
        } catch (\Exception $e) {
            return back()->with('message', 'Nastąpił błąd w trakcie zapisu.');
        }
    }

    public function destroy(Brand $brand): RedirectResponse
    {
        try {
            $this->brandService->destroy($brand);
            return redirect()->route('brands')->with('message', 'Marka została usunięta.');
        } catch (\Exception $e) {
            return back()->with('message', 'Nastąpił błąd w trakcie usuwania.');
        }
    }
}
