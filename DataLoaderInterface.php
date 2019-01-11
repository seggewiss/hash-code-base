<?php declare(strict_types=1);

interface DataLoaderInterface
{
    public function load(string $file): InputData;
}