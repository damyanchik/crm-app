<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\FileDataImporter;

class FileDataImporter
{
    private AbstractFactory $factory;

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

        return $processor->process($data);
    }
}
