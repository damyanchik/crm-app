<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\ProductUnitEnum;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\StoreAndUpdateOfferRequest;
use App\Http\Requests\StoreAndUpdateOfferItemsRequest;
use App\Models\Order;
use App\Services\OfferService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OfferController extends Controller
{
    public function __construct(protected OfferService $offerService)
    {
    }

    public function index(IndexRequest $indexRequest): View
    {
        return view('orders.offers.index', [
            'offers' => $this->offerService->getAll($indexRequest->getSearchParams())
        ]);
    }

    public function create(): View
    {
        return view('orders.offers.create', [
            'jsonUnits' => json_encode(ProductUnitEnum::getAllUnits()),
            'products' => [],
        ]);
    }

    public function store(
        StoreAndUpdateOfferRequest $offerRequest,
        StoreAndUpdateOfferItemsRequest $itemsRequest
    ): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->offerService->store($offerRequest->validated(), $itemsRequest->validated());
            DB::commit();
            return redirect()
                ->route('storeOffer')
                ->with('message', 'Utworzono nową ofertę.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Błąd w tworzeniu oferty, spróbuj ponownie!');
        }
    }

    public function edit(Order $offer): View
    {
        return view('orders.offers.edit', [
            'jsonUnits' => json_encode(ProductUnitEnum::getAllUnits()),
            'offer' => $offer
        ]);
    }

    public function update(
        Order $offer,
        StoreAndUpdateOfferRequest $offerRequest,
        StoreAndUpdateOfferItemsRequest $itemsRequest
    ): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->offerService->update($offer, $offerRequest->validated(), $itemsRequest->validated());
            DB::commit();
            return back()
                ->with('message', 'Oferta została zaktualizowana.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Błąd w tworzeniu oferty, spróbuj ponownie!');
        }
    }

    public function destroy(Order $offer): RedirectResponse
    {
        try {
            $this->offerService->destroy($offer);
            return redirect('/offers')
                ->with('message', 'Oferta została usunięta.');
        } catch (\Exception $e) {
            return redirect('/offers')
                ->with('message', 'Nastąpił błąd w trakcie usuwania.');
        }
    }

    public function makeOrder(Order $offer): RedirectResponse
    {
        try {
            $this->offerService->transformToOrder($offer);
            return redirect()
                ->route('orders')
                ->with(
                    'message',
                    'Utworzono nowe zamówienie o numerze '.$offer->invoice_num.'.'
                );
        } catch (\Exception $e) {
            return redirect('/offers')
                ->with('message', 'Nastąpił błąd w trakcie tworzenia zamówienia.');
        }
    }
}
