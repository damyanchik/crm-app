<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\CsvHelper;
use App\Helpers\StockHelper;
use App\Models\Order;
use App\Models\OrderItem;
use App\Patterns\AbstractFactories\FileDataImporter\FileDataImporter;
use App\Patterns\AbstractFactories\FileDataImporter\ProductForOfferImporter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OfferService
{
    public function validateAndStoreOffer(FormRequest $offerForm, FormRequest $offerItemsForm): void
    {
        DB::beginTransaction();

        try {
            $offerValidated = $offerForm->validated();
            $offerItemsValidated = $offerItemsForm->validated();
            $newOrder = Order::create($offerValidated);

            foreach ($offerItemsValidated['products'] as $orderItem) {
                $orderItem['user_id'] = $offerValidated['user_id'];
                $orderItem['order_id'] = $newOrder->id;
                StockHelper::takeQuantityFromProductByCode($orderItem['code'], $orderItem['quantity']);
                OrderItem::create($orderItem);
            }

            DB::commit();
            Session::flash('success', 'Oferta została utworzona.');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Błąd w tworzeniu oferty, spróbuj ponownie!.');
        }
    }

    public function validateAndUpdateOffer(FormRequest $offerForm, FormRequest $offerItemsForm, Order $order): void
    {
        DB::beginTransaction();

        try {
            $offerValidated = $offerForm->validated();
            $offersItemsValidated = $offerItemsForm->validated();

            $order->update($offerValidated);

            StockHelper::removeAllQuantityToProducts($order);

            $order->orderItem()->delete();

            foreach ($offersItemsValidated['products'] as $offerItem) {
                $offerItem['user_id'] = $offerValidated['user_id'];
                $offerItem['order_id'] = $order->id;
                StockHelper::takeQuantityFromProductByCode($offerItem['code'], $offerItem['quantity']);
                OrderItem::create($offerItem);
            }

            DB::commit();
            Session::flash('success', 'Oferta została zaktualizowana.');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Błąd w aktualizacji oferty, spróbuj ponownie.');
        }
    }

    public function validateAndImportCsv(FormRequest $request): array
    {
        $request->validated();
        $csvData = $request->file('csv_file');

        $csvData = CsvHelper::readToArray(
            $csvData->getPathname(),
            ['code', 'quantity', 'price']
        );

        $fileImportProcessor = new FileDataImporter(new ProductForOfferImporter());

        return $fileImportProcessor->processData($csvData);
    }
}
