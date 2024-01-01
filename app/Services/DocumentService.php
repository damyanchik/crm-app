<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use App\Patterns\AbstractFactories\DocumentFactory\DocumentFactory;
use App\Patterns\AbstractFactories\DocumentFactory\Factories\InvoiceFactory;
use App\Patterns\AbstractFactories\DocumentFactory\Factories\OfferFactory;

class DocumentService
{
    public function __construct(protected DocumentFactory $documentFactory)
    {
    }

    public function generateInvoice(Order $order, string $action): object
    {
        $this->documentFactory->setFactory(new InvoiceFactory());
        $this->documentFactory->createDocument($order);

        return match ($action) {
            'download' => $this->documentFactory->download('invoice_' . $order->invoice_num),
            'stream' => $this->documentFactory->stream('invoice_' . $order->invoice_num),
            default => throw new \InvalidArgumentException('Niepoprawna akcja dla generowania faktury.'),
        };
    }

    public function generateOffer(Order $offer, string $action): object
    {
        $this->documentFactory->setFactory(new OfferFactory());
        $this->documentFactory->createDocument($offer);

        return match ($action) {
            'download' => $this->documentFactory->download('offer_' . $offer->id),
            'stream' => $this->documentFactory->stream('offer_' . $offer->id),
            default => throw new \InvalidArgumentException('Niepoprawna akcja dla wygenerowania oferty.'),
        };
    }
}
