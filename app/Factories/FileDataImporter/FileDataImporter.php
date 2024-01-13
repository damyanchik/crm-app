<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter;

use App\Factories\FileDataImporter\Factories\SimpleFactory;

class FileDataImporter
{
    private SimpleFactory $factory;

    public function setFactory(SimpleFactory $factory): void
    {
        $this->factory = $factory;
    }

    public function processData(array $data): array
    {
        $validator = $this->factory->createValidator();
        $processor = $this->factory->createProcessor();

        if (!$validator->validate($data)) {
            return [];
        }

        return $processor->process($data);
    }
}
