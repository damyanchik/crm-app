<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\ProductUnitEnum;
use App\Http\Requests\ImportCsvRequest;
use App\Services\OfferService;
use App\Services\ProductService;

class CSVImportController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected OfferService $offerService
    )
    {
    }

    public function importToStoreProducts(ImportCsvRequest $request): object
    {
        $this->productService->validateAndImportNewProduct($request);

        return back()->with('test');
    }

    public function importToUpdateQuantityAndPrice(ImportCsvRequest $request): object
    {
        $this->productService->validateAndImportUpdateProduct($request);

        return back()->with('tes asdas das asd sd');
    }

    public function importToOffer(ImportCsvRequest $request): object
    {
        return view('orders.offers.create',[
            'jsonUnits' => json_encode(ProductUnitEnum::getAllUnits()),
            'products' => $this->offerService->validateAndImportCsv($request)]);
    }
}
