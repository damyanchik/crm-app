<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Processors;

interface ProcessorInterface
{
    public function process(array $data): array;
}
