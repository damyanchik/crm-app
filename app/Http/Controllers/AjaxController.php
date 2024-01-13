<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\BrandRepository;
use App\Repositories\ClientRepository;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
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
            'users' => $this->ajaxService->getUsers(new UserRepository(), $request->input('searchTerm'))
        ]);
    }

    public function searchClient(Request $request): JsonResponse
    {
        return response()->json([
            'clients' => $this->ajaxService->getClients(new ClientRepository(), $request->input('searchTerm'))
        ]);
    }

    public function searchBrand(Request $request): JsonResponse
    {
        return response()->json([
            'brands' => $this->ajaxService->getBrands(new BrandRepository(), $request->input('searchTerm'))
        ]);
    }

    public function searchProductCategory(Request $request): JsonResponse
    {
        return response()->json([
            'productCategories' => $this->ajaxService->getProductCategories(
                new ProductCategoryRepository(),
                $request->input('searchTerm')
            )
        ]);
    }

    public function searchProduct(Request $request): JsonResponse
    {
        return response()->json([
            'products' => $this->ajaxService->getProducts(new ProductRepository(), $request->input('searchTerm'))
        ]);
    }
}
