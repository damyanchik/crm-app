<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Brand;
use App\Models\Client;
use App\Models\ProductCategory;
use App\Models\User;
use App\Repositories\BrandRepository;
use App\Repositories\ClientRepository;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;

class AjaxService
{
    public function getUsers(UserRepository $userRepository, string $searchTerm): object
    {
        return $userRepository->searchWhereItems(
            User::query(),
            $searchTerm,
            ['name', 'surname', 'email']
        );
    }

    public function getClients(ClientRepository $clientRepository, string $searchTerm): object
    {
        return $clientRepository->searchWhereItems(
            Client::query(),
            $searchTerm,
            ['name', 'surname', 'company', 'tax', 'email']
        );
    }

    public function getBrands(BrandRepository $brandRepository, string $searchTerm): object
    {
        return $brandRepository->searchWhereItems(
            Brand::query(),
            $searchTerm,
            ['name']
        );
    }

    public function getProductCategories(ProductCategoryRepository $productCategoryRepository, string $searchTerm): object
    {
        return $productCategoryRepository->searchWhereItems(
            ProductCategory::query(),
            $searchTerm,
            ['name']
        );
    }

    public function getProducts(ProductRepository $productRepository, string $searchTerm): object
    {
        return $productRepository->searchProducts($searchTerm);
    }
}
