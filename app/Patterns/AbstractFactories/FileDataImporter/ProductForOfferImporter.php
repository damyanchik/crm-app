<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\FileDataImporter;

class ProductForOfferImporter implements AbstractFactory
{
    public function createValidator(): ValidatorInterface
    {
        return new ProductForOffer();
    }

    public function createProcessor(): ProcessorInterface
    {
        return new ProductForOfferProcessor();
    }
}
