<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\FileDataImporter\Factories;

use App\Patterns\AbstractFactories\FileDataImporter\Processors\ProcessorInterface;
use App\Patterns\AbstractFactories\FileDataImporter\Processors\ProductForOfferProcessor;
use App\Patterns\AbstractFactories\FileDataImporter\Processors\ProductUpdateProcessor;
use App\Patterns\AbstractFactories\FileDataImporter\Validators\ProductForOfferValidator;
use App\Patterns\AbstractFactories\FileDataImporter\Validators\ProductUpdateValidator;
use App\Patterns\AbstractFactories\FileDataImporter\Validators\ValidatorInterface;

class ProductUpdateFactory implements AbstractFactory
{
    public function createValidator(): ValidatorInterface
    {
        return new ProductUpdateValidator();
    }

    public function createProcessor(): ProcessorInterface
    {
        return new ProductUpdateProcessor();
    }
}
