<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\ProductUnitEnum;
use App\Helpers\CsvHelper;
use App\Http\Requests\ImportOrderCsvRequest;
use App\Models\Order;
use App\Services\OrderService;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\StoreOrdersItemsRequest;
use App\Validators\OrderCsvValidator;

class OrdersController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(): object
    {
        $orders = Order::search(request('search'))
            ->sortBy(request('column') ?? 'id', request('order') ?? 'asc')
            ->paginate(request('display'));

        return view('orders.index', [
            'orders' => $orders
        ]);
    }

    public function show(Order $order): object
    {
        return view('orders.show', [
            'order' => $order,
        ]);
    }

    public function create(): object
    {
        return view('orders.create', [
            'jsonUnits' => json_encode(ProductUnitEnum::getAllUnits())
        ]);
    }

    public function store(StoreOrderRequest $orderRequest, StoreOrdersItemsRequest $ordersItemsRequest): object
    {
        $this->orderService->validateAndStoreOrder($orderRequest, $ordersItemsRequest);

        return redirect('/orders')->with('message', 'Utworzono zamówienie.');
    }

    public function import(ImportOrderCsvRequest $request): object
    {
        $request->validated();
        $csvFile = $request->file('csv_file');

        $csvData = CsvHelper::readToArray(
            $csvFile->getPathname(),
            ['code', 'quantity', 'price']
        );

        $validator = OrderCsvValidator::validate($csvData);
        $errors = $validator->errors();

        if (!empty($errors->messages()))
            return back()->with('message', 'Wykryto błąd w przesłanym pliku CSV, sprawdź poprawność kolumn.');

        return view('orders.create', [
            'jsonUnits' => json_encode(ProductUnitEnum::getAllUnits()),
            'productsFromCsv' => $this->orderService->importCsv($csvData),
        ]);
    }
}
