<?php declare(strict_types=1);

//include __DIR__ . '/InputData.php';

interface ProcessorInterface
{
    public function process(InputData $data): array;
}