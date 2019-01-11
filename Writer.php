<?php declare(strict_types=1);

include __DIR__ . '/WriterInterface.php';

class Writer implements WriterInterface
{
    public const OUTPUT_FILE = __DIR__ . '/example.out';

    public function write(array $data, string $name): void
    {
        $handler = fopen(__DIR__  . '/output/' . $name . time() . '.out', 'w');
        foreach($data as $row){
            fwrite($handler,implode(' ', $row) . PHP_EOL);
        }
        fclose($handler);
    }

    public function zip(): void
    {
        exec('zip -r output/source' . time() .'.zip *.php');
    }
}