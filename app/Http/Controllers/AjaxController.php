<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AjaxService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function __construct(protected AjaxService $ajaxService)
    {
    }

    public function searchUser(Request $request): JsonResponse
    {
        return response()->json([
            'users' => $this->ajaxService->getUsers($request->input('searchTerm'))
        ]);
    }

    public function searchClient(Request $request): JsonResponse
    {
        return response()->json([
            'clients' => $this->ajaxService->getClients($request->input('searchTerm'))
        ]);
    }

    public function searchBrand(Request $request): JsonResponse
    {
        return response()->json([
            'brands' => $this->ajaxService->getBrands($request->input('searchTerm'))
        ]);
    }

    public function searchProductCategory(Request $request): JsonResponse
    {
        return response()->json([
            'productCategories' => $this->ajaxService->getProductCategories($request->input('searchTerm'))
        ]);
    }

    public function searchProduct(Request $request): JsonResponse
    {
        return response()->json([
            'products' => $this->ajaxService->getProducts($request->input('searchTerm'))
        ]);
    }
}
