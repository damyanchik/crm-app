<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\FileDataImporter;

interface AbstractFactory
{
    public function createValidator(): ValidatorInterface;
    public function createProcessor(): ProcessorInterface;
}
