<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\FileDataImporter\Factories;

use App\Patterns\AbstractFactories\FileDataImporter\Processors\ProcessorInterface;
use App\Patterns\AbstractFactories\FileDataImporter\Processors\ProductForOfferProcessor;
use App\Patterns\AbstractFactories\FileDataImporter\Validators\ProductForOfferValidator;
use App\Patterns\AbstractFactories\FileDataImporter\Validators\ValidatorInterface;

class ProductForOfferFactory implements AbstractFactory
{
    public function createValidator(): ValidatorInterface
    {
        return new ProductForOfferValidator();
    }

    public function createProcessor(): ProcessorInterface
    {
        return new ProductForOfferProcessor();
    }
}
