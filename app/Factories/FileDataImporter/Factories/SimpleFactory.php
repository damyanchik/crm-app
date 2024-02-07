<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Factories;

use App\Factories\FileDataImporter\Processors\ProcessorInterface;
use App\Factories\FileDataImporter\Validators\ValidatorInterface;

interface SimpleFactory
{
    public function createValidator(): ValidatorInterface;
    public function createProcessor(): ProcessorInterface;
}
