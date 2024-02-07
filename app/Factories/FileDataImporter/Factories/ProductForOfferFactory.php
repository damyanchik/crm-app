<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Factories;

use App\Factories\FileDataImporter\Processors\ProcessorInterface;
use App\Factories\FileDataImporter\Processors\ProductForOfferProcessor;
use App\Factories\FileDataImporter\Validators\ProductForOfferValidator;
use App\Factories\FileDataImporter\Validators\ValidatorInterface;

class ProductForOfferFactory implements SimpleFactory
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
