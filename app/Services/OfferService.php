<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Strategies\OfferCsvStrategy;
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
            $offerValidated['invoice_num'] = 'test';
            $newOrder = Order::create($offerValidated);

            foreach ($offerItemsValidated['products'] as $orderItem) {
                $orderItem['user_id'] = $offerValidated['user_id'];
                $orderItem['order_id'] = $newOrder->id;
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

            $order->orderItem()->delete();

            foreach ($offersItemsValidated['products'] as $offerItem) {
                $offerItem['user_id'] = $offerValidated['user_id'];
                $offerItem['order_id'] = $order->id;
                OrderItem::create($offerItem);
            }

            DB::commit();
            Session::flash('success', 'Oferta została zaktualizowana.');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Błąd w aktualizacji oferty, spróbuj ponownie.');
        }
    }

    public function importCsv(array $csvData): object
    {
        $orderImport = new CsvImportService();
        $orderImport->setCsvImportStrategy(new OfferCsvStrategy());

        return $orderImport->importDataFromCsv($csvData);
    }

    public function generateInvoiceNumber(Order $offer): void
    {
        $orderMonthQuantity = DB::table('orders')
            ->select(DB::raw('COUNT(*) as quantity'))
            ->whereMonth('created_at', '=', date('m'))
            ->first();

        $invoiceNumber = $orderMonthQuantity->quantity+1;

        $now = now();

        $invoice = $invoiceNumber.'/FV/'.$now->month.'/'.$now->year;

        while (Order::where('invoice_num', '=', $invoice)->exists()) {
            $invoiceNumber = $invoiceNumber+1;
            $invoice = $invoiceNumber.'/FV/'.$now->month.'/'.$now->year;
        }

        $offer->setAttribute('invoice_num', $invoiceNumber.'/FV/'.$now->month.'/'.$now->year);
    }
}
