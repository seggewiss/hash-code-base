<?php declare(strict_types=1);

interface ProcessorInterface
{
    public function process(InputData $data): array;
}