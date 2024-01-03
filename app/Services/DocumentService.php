<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CompanyInfo;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class DocumentService
{
    public function generateInvoice(Order $order): object
    {
        $pdfDetails = [
            'order' => $order,
            'company' => CompanyInfo::all()->first()
        ];

        return Pdf::loadView('pdf.invoice', $pdfDetails)->download('inv_'.$order->invoice_num.'.pdf');
    }

    public function generateOffer(Order $offer): object
    {
        $pdfDetails = [
            'order' => $offer,
            'company' => CompanyInfo::all()->first()
        ];

        return Pdf::loadView('pdf.offer', $pdfDetails)->download('offer_nr_'.$offer->id.'.pdf');
    }
}
