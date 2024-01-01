<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\DocumentFactory\Factories;

use App\Patterns\AbstractFactories\DocumentFactory\DataFormatters\DataFormatterInterface;
use App\Patterns\AbstractFactories\DocumentFactory\DataFormatters\InvoiceDataFormatter;
use App\Patterns\AbstractFactories\DocumentFactory\PDFGenerators\PDFGeneratorInterface;
use App\Patterns\AbstractFactories\DocumentFactory\PDFGenerators\InvoicePDFGenerator;

class InvoiceFactory implements AbstractFactory
{
    public function createDataFormatter(): DataFormatterInterface
    {
        return new InvoiceDataFormatter();
    }

    public function createPDFGenerator(): PDFGeneratorInterface
    {
        return new InvoicePDFGenerator();
    }
}
