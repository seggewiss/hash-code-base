<?php declare(strict_types=1);

interface DataLoaderInterface
{
    public function load(string $file): InputData;
    public function getFilesToProcess(): array;
    public function printFilesToProcess(array $files): void;
}