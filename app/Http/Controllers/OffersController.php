<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\ProductUnitEnum;
use App\Http\Requests\StoreAndUpdateOfferRequest;
use App\Http\Requests\StoreAndUpdateOfferItemsRequest;
use App\Models\Order;
use App\Services\OfferService;
use Illuminate\Support\Facades\DB;

class OffersController extends Controller
{
    public function __construct(protected OfferService $offerService)
    {
    }

    public function index(): object
    {
        return view('orders.offers.index', [
            'offers' => $this->offerService->getOffers()
        ]);
    }

    public function create(): object
    {
        return view('orders.offers.create', [
            'jsonUnits' => json_encode(ProductUnitEnum::getAllUnits()),
            'products' => [],
        ]);
    }

    public function store(StoreAndUpdateOfferRequest $offerRequest, StoreAndUpdateOfferItemsRequest $itemsRequest): object
    {
        DB::beginTransaction();

        try {
            $offerValidated = $offerRequest->validated();
            $offerItemsValidated = $itemsRequest->validated();
            $this->offerService->store($offerValidated, $offerItemsValidated);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Błąd w tworzeniu oferty, spróbuj ponownie!');
        }

        return redirect('/offers')->with('message', 'Utworzono nową ofertę.');
    }

    public function edit(Order $offer): object
    {
        return view('orders.offers.edit', [
            'jsonUnits' => json_encode(ProductUnitEnum::getAllUnits()),
            'offer' => $offer
        ]);
    }

    public function update(StoreAndUpdateOfferRequest $offerRequest, StoreAndUpdateOfferItemsRequest $itemsRequest, Order $offer): object
    {
        DB::beginTransaction();

        try {
            $offerValidated = $offerRequest->validated();
            $offersItemsValidated = $itemsRequest->validated();
            $this->offerService->update($offerValidated, $offersItemsValidated, $offer);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Błąd w tworzeniu oferty, spróbuj ponownie!');
        }

        return back()->with('message', 'Oferta została zaktualizowana.');
    }

    public function destroy(Order $offer): object
    {
        $this->offerService->destroy($offer);

        return redirect('/offers')->with('message', 'Oferta została usunięta.');
    }

    public function makeOrder(Order $offer): object
    {
        $this->offerService->transformToOrder($offer);

        return redirect('/orders')->with(
            'message',
            'Utworzono nowe zamówienie o numerze '.$offer->invoice_num.'.'
        );
    }
}
