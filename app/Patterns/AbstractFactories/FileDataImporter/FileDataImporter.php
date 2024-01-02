<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\FileDataImporter;

use App\Patterns\AbstractFactories\FileDataImporter\Factories\AbstractFactory;

class FileDataImporter
{
    public function setFactory(AbstractFactory $factory): void
    {
        $this->factory = $factory;
    }

    public function processData(array $data): array
    {
        $validator = $this->factory->createValidator();
        $processor = $this->factory->createProcessor();

        if (!$validator->validate($data))
            return [];

        return $processor->process($data);
    }
}
