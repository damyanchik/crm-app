<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AjaxService;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function __construct(protected AjaxService $ajaxService)
    {
    }

    public function searchUsers(Request $request): object
    {
        $searchTerm = $request->input('searchTerm');

        return response()->json([
            'users' => $this->ajaxService->getUsers($searchTerm)
        ]);
    }

    public function searchClients(Request $request): object
    {
        $searchTerm = $request->input('searchTerm');

        return response()->json([
            'clients' => $this->ajaxService->getClients($searchTerm)
        ]);
    }

    public function searchBrands(Request $request): object
    {
        $searchTerm = $request->input('searchTerm');

        return response()->json([
            'brands' => $this->ajaxService->getBrands($searchTerm)
        ]);
    }

    public function searchProductCategories(Request $request): object
    {
        $searchTerm = $request->input('searchTerm');

        return response()->json([
            'productCategories' => $this->ajaxService->getProductCategories($searchTerm)
        ]);
    }

    public function searchProducts(Request $request): object
    {
        $searchTerm = $request->input('searchTerm');

        return response()->json([
            'products' => $this->ajaxService->getProducts($searchTerm)
        ]);
    }
}
