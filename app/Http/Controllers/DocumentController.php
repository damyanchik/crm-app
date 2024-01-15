<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\OrderStatusEnum;
use App\Models\Order;
use App\Services\DocumentService;

class DocumentController extends Controller
{
    public function __construct(protected DocumentService $documentService)
    {
    }

    public function generateInvoice(Order $order): object
    {
        if (!in_array($order->status, [
            OrderStatusEnum::READY['id'],
            OrderStatusEnum::CLOSED['id']
        ])) {
            return back()
                ->with('message', 'Błąd w trakcie generowania faktury.');
        }

        try {
            return $this->documentService->generateInvoice($order);
        } catch (\Exception $e) {
            return back()
                ->with('message', 'Błąd w trakcie generowania faktury.');
        }
    }

    public function generateOffer(Order $offer): object
    {
        try {
            return $this->documentService->generateOffer($offer);
        } catch (\Exception $e) {
            return back()
                ->with('message', 'Błąd w trakcie generowania oferty.');
        }
    }
}
