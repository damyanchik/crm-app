<?php

declare(strict_types=1);

namespace App\Services;

use App\Enum\OrderStatusEnum;
use App\Models\Order;
use App\Repositories\CompanyRepository;
use Barryvdh\DomPDF\Facade\Pdf;

class DocumentService
{
    public function __construct(protected CompanyRepository $companyRepository)
    {
    }

    public function generateInvoice(Order $order): object
    {
        $pdfDetails = [
            'order' => $order,
            'company' => $this->companyRepository->findById(1)
        ];

        return Pdf::loadView('pdf.invoice', $pdfDetails)->download('inv_'.$order->invoice_num.'.pdf');
    }

    public function generateOffer(Order $offer): object
    {
        $pdfDetails = [
            'order' => $offer,
            'company' => $this->companyRepository->findById(1)
        ];

        return Pdf::loadView('pdf.offer', $pdfDetails)->download('offer_nr_'.$offer->id.'.pdf');
    }

    public function isOrderGenerationPermitted(int $status): bool
    {
        return !in_array($status, [
            OrderStatusEnum::READY['id'],
            OrderStatusEnum::CLOSED['id']
        ]);
    }
}
