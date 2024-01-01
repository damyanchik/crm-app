<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\DocumentFactory\PDFGenerators;

interface PDFGeneratorInterface
{
    public function generate(array $preparedData);
}
