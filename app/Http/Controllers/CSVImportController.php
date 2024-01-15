<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\ProductUnitEnum;
use App\Http\Requests\ImportCsvRequest;
use App\Services\CSVService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CSVImportController extends Controller
{
    public function __construct(
        protected CSVService $CSVService
    )
    {
    }

    public function importToStoreProducts(ImportCsvRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->CSVService->importNewProduct($request->file('csv_file'));
            DB::commit();
            return back()
                ->with('message', 'Nowe produktu zostały dodane do bazy.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Nastąpił błąd w trakcie dodawania nowych produktów! Sprawdź czy produkty już istnieją.');
        }
    }

    public function importToUpdateQuantityAndPrice(ImportCsvRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->CSVService->importProductToUpdate($request->file('csv_file'));
            DB::commit();
            return back()
                ->with('message', 'Produkty zostały zaktualizowane.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Nastąpił błąd w trakcie aktualizacji produktów!');
        }
    }

    public function importToOffer(ImportCsvRequest $request): View
    {
        return view('orders.offers.create',[
            'jsonUnits' => json_encode(ProductUnitEnum::getAllUnits()),
            'products' => $this->CSVService->validateAndImportCsv($request->file('csv_file'))]
        );
    }
}
