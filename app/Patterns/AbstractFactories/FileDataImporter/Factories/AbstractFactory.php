<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\FileDataImporter\Factories;

use App\Patterns\AbstractFactories\FileDataImporter\Processors\ProcessorInterface;
use App\Patterns\AbstractFactories\FileDataImporter\Validators\ValidatorInterface;

interface AbstractFactory
{
    public function createValidator(): ValidatorInterface;
    public function createProcessor(): ProcessorInterface;
}
