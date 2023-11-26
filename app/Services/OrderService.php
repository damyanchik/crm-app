<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\CsvHelper;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Strategies\OrderCsvStrategy;
use App\Validators\OrderCsvValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function validateAndStoreOrder(FormRequest $orderForm, FormRequest $orderItemsForm): void
    {
        DB::beginTransaction();

        try {
            $orderValidated = $orderForm->validated();
            $ordersItemsValidated = $orderItemsForm->validated();

            $orderValidated['invoice_num'] = $this->generateInvoiceNumber();
            $newOrder = Order::create($orderValidated);

            foreach ($ordersItemsValidated['products'] as $orderItem) {
                $orderItem['user_id'] = $orderValidated['user_id'];
                $orderItem['order_id'] = $newOrder->id;
                OrderItem::create($orderItem);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function validateAndImportCsv(FormRequest $request): object
    {
        $request->validated();

        $csvFile = $request->file('csv_file');

        $csvData = CsvHelper::readToArray(
            $csvFile->getPathname(),
            ['code', 'quantity', 'price']
        );

        $validator = OrderCsvValidator::validate($csvData);
        $errors = $validator->errors();

        if (!empty($errors->all()))
            return back()->with('message', 'Wykryto błąd w przesłanym pliku CSV, sprawdź poprawność kolumn.');

        $orderImport = new CsvImportService();
        $orderImport->setCsvImportStrategy(new OrderCsvStrategy());

        return $orderImport->importDataFromCsv($csvData);
    }

    private function generateInvoiceNumber(): string
    {
        $orderMonthQuantity = DB::table('orders')
            ->select(DB::raw('COUNT(*) as quantity'))
            ->whereMonth('created_at', '=', date('m'))
            ->first();

        $invoiceNumber = $orderMonthQuantity->quantity+1;

        $now = now();

        return $invoiceNumber.'/FV/'.$now->month.'/'.$now->year;
    }
}
