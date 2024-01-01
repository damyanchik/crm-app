<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\DocumentFactory\PDFGenerators;

use Barryvdh\DomPDF\Facade\Pdf;

class OfferPDFGenerator implements PDFGeneratorInterface
{
    public function generate(array $preparedData): object
    {
        return Pdf::loadView('pdf.offer', $preparedData);
    }
}
