<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Factories;

use App\Factories\FileDataImporter\Processors\ProductAdditionProcessor;
use App\Factories\FileDataImporter\Processors\ProcessorInterface;
use App\Factories\FileDataImporter\Validators\ProductAdditionValidator;
use App\Factories\FileDataImporter\Validators\ValidatorInterface;

class ProductAdditionFactory implements SimpleFactory
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
