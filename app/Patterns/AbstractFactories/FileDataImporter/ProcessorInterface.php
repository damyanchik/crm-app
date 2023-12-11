<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\FileDataImporter;

interface ProcessorInterface
{
    public function process(array $data): array;
}
