<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\DocumentFactory\Factories;

use App\Patterns\AbstractFactories\DocumentFactory\DataFormatters\DataFormatterInterface;
use App\Patterns\AbstractFactories\DocumentFactory\DataFormatters\OfferDataFormatter;
use App\Patterns\AbstractFactories\DocumentFactory\PDFGenerators\OfferPDFGenerator;
use App\Patterns\AbstractFactories\DocumentFactory\PDFGenerators\PDFGeneratorInterface;

class OfferFactory implements AbstractFactory
{
    public function createDataFormatter(): DataFormatterInterface
    {
        return new OfferDataFormatter();
    }

    public function createPDFGenerator(): PDFGeneratorInterface
    {
        return new OfferPDFGenerator();
    }
}
