<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\DocumentFactory\Factories;

use App\Patterns\AbstractFactories\DocumentFactory\DataFormatters\DataFormatterInterface;
use App\Patterns\AbstractFactories\DocumentFactory\PDFGenerators\PDFGeneratorInterface;

interface AbstractFactory
{
    public function createDataFormatter(): DataFormatterInterface;
    public function createPDFGenerator(): PDFGeneratorInterface;
}
