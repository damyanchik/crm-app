<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\DocumentFactory;

use App\Patterns\AbstractFactories\DocumentFactory\Factories\AbstractFactory;
use Barryvdh\DomPDF\PDF;

class DocumentFactory
{
    private PDF $document;
    private AbstractFactory $factory;

    public function setFactory(AbstractFactory $factory): void
    {
        $this->factory = $factory;
    }

    public function createDocument(object $data): void
    {
        $dataFormatter = $this->factory->createDataFormatter();
        $PDFGenerator = $this->factory->createPDFGenerator();

        $this->document = $PDFGenerator->generate($dataFormatter->prepareData($data));
    }

    public function stream(string $fileName): object
    {
        return $this->document->stream($fileName.'.pdf');
    }

    public function download(string $fileName): object
    {
        return $this->document->download($fileName.'.pdf');
    }
}
