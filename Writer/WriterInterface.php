<?php declare(strict_types=1);

interface WriterInterface
{
    public function write(array $data, string $name): void;
    public function zip(): void;
}