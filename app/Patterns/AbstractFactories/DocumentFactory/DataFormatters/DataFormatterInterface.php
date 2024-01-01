<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\DocumentFactory\DataFormatters;

interface DataFormatterInterface
{
    public function prepareData(object $data): array;
}
