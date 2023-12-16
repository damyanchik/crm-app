<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\FileDataImporter;

use App\Patterns\AbstractFactories\FileDataImporter\Factories\AbstractFactory;

class FileDataImporter
{
    private AbstractFactory $factory;
    private array $importedData;

    public function __construct(AbstractFactory $factory)
    {
        $this->factory = $factory;
    }

    public function processData(array $data): array
    {
        $validator = $this->factory->createValidator();
        $processor = $this->factory->createProcessor();

        if (!$validator->validate($data))
            return [];

        return $this->importedData = $processor->process($data);
    }
}
