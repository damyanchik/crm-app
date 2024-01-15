<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\BrandService;
use App\Services\ClientService;
use App\Services\EmployeeService;
use App\Services\ProductCategoryService;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function searchUser(Request $request, EmployeeService $employeeService): JsonResponse
    {
        return response()
            ->json([
                'users' => $employeeService->handleAjax($request->input('searchTerm'))
        ]);
    }

    public function searchClient(Request $request, ClientService $clientService): JsonResponse
    {
        return response()
            ->json([
                'clients' => $clientService->handleAjax($request->input('searchTerm'))
        ]);
    }

    public function searchBrand(Request $request, BrandService $brandService): JsonResponse
    {
        return response()
            ->json([
                'brands' => $brandService->handleAjax($request->input('searchTerm'))
            ]);
    }

    public function searchProductCategory(Request $request, ProductCategoryService $productCategoryService): JsonResponse
    {
        return response()
            ->json([
                'productCategories' => $productCategoryService->handleAjax($request->input('searchTerm'))
        ]);
    }

    public function searchProduct(Request $request, ProductService $productService): JsonResponse
    {
        return response()
            ->json([
                'products' => $productService->handleAjax($request->input('searchTerm'))
            ]);
    }
}
