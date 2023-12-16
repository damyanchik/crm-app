<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\FileDataImporter\Factories;

use App\Patterns\AbstractFactories\FileDataImporter\Processors\ProductAdditionProcessor;
use App\Patterns\AbstractFactories\FileDataImporter\Processors\ProcessorInterface;
use App\Patterns\AbstractFactories\FileDataImporter\Validators\ProductAdditionValidator;
use App\Patterns\AbstractFactories\FileDataImporter\Validators\ValidatorInterface;

class ProductAdditionFactory implements AbstractFactory
{
    public function createValidator(): ValidatorInterface
    {
        return new ProductAdditionValidator();
    }

    public function createProcessor(): ProcessorInterface
    {
        return new ProductAdditionProcessor();
    }
}
