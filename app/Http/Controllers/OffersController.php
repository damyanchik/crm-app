<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\OrderStatusEnum;
use App\Enum\ProductUnitEnum;
use App\Helpers\CsvHelper;
use App\Http\Requests\ImportOfferCsvRequest;
use App\Http\Requests\StoreAndUpdateOfferRequest;
use App\Http\Requests\StoreAndUpdateOfferItemsRequest;
use App\Models\Order;
use App\Services\OfferService;

class OffersController extends Controller
{
    protected OfferService $offerService;

    public function __construct(OfferService $offerService)
    {
        $this->offerService = $offerService;
    }

    public function index(): object
    {
        $offers = Order::search(request('search'))
            ->where(function ($query) {
                $query->whereIn('status', [
                    OrderStatusEnum::OFFER['id'],
                    OrderStatusEnum::ACCEPTED['id']
                ]);
            })
            ->sortBy(
                request('column') ?? 'id',
                request('order') ?? 'asc'
            )
            ->paginate(request('display'));

        return view('orders.offers.index', [
            'offers' => $offers
        ]);
    }

    public function create(): object
    {
        return view('orders.offers.create', [
            'jsonUnits' => json_encode(ProductUnitEnum::getAllUnits())
        ]);
    }

    public function store(StoreAndUpdateOfferRequest $offerRequest, StoreAndUpdateOfferItemsRequest $itemsRequest): object
    {
        $this->offerService->validateAndStoreOffer($offerRequest, $itemsRequest);

        return back();
    }

    public function import(ImportOfferCsvRequest $request): object
    {
        $request->validated();
        $csvData = $request->file('csv_file');

        $csvData = CsvHelper::readToArray(
            $csvData->getPathname(),
            ['code', 'quantity', 'price']
        );

        return view('orders.offers.create', [
            'jsonUnits' => json_encode(ProductUnitEnum::getAllUnits()),
            'productsFromCsv' => $this->offerService->importCsv($csvData),
        ]);
    }

    public function edit(Order $offer): object
    {
        return view('orders.offers.edit', [
            'jsonUnits' => json_encode(ProductUnitEnum::getAllUnits()),
            'offer' => $offer
        ]);
    }

    public function update(StoreAndUpdateOfferRequest $offerRequest, StoreAndUpdateOfferItemsRequest $itemsRequest, Order $offer)
    {
        $this->offerService->validateAndUpdateOffer($offerRequest, $itemsRequest, $offer);

        return back()->with(
            'message',
            'Oferta została zaktualizowana.'
        );
    }

    public function destroy(Order $offer): object
    {
        $offer->delete();

        return redirect('/offers');
    }

    public function makeOrder(Order $offer): object
    {
        $this->offerService->generateInvoiceNumber($offer);
        $offer->setAttribute('status', OrderStatusEnum::PENDING['id']);
        $offer->setUpdatedAt(now());
        $offer->save();

        return redirect('/orders')->with(
            'Utworzono nowe zamówienie o numerze '.$offer->invoice_num.'.'
        );
    }
}
