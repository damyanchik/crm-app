<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Factories;

use App\Factories\FileDataImporter\Processors\ProcessorInterface;
use App\Factories\FileDataImporter\Processors\ProductUpdateProcessor;
use App\Factories\FileDataImporter\Validators\ProductUpdateValidator;
use App\Factories\FileDataImporter\Validators\ValidatorInterface;

class ProductUpdateFactory implements SimpleFactory
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
