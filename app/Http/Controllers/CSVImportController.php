<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\ProductUnitEnum;
use App\Http\Requests\ImportCsvRequest;
use App\Services\OfferService;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();

        try {
            $this->productService->validateAndImportNewProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Nastąpił błąd w trakcie dodawania nowych produktów! Sprawdź czy produkty już istnieją.');
        }

        return back()->with('message', 'Nowe produktu zostały dodane do bazy.');
    }

    public function importToUpdateQuantityAndPrice(ImportCsvRequest $request): object
    {
        DB::beginTransaction();

        try {
            $this->productService->validateAndImportUpdateProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Nastąpił błąd w trakcie aktualizacji produktów!');
        }

        return back()->with('message', 'Produkty zostały zaktualizowane.');
    }

    public function importToOffer(ImportCsvRequest $request): object
    {
        return view('orders.offers.create',[
            'jsonUnits' => json_encode(ProductUnitEnum::getAllUnits()),
            'products' => $this->offerService->validateAndImportCsv($request)]
        );
    }
}
