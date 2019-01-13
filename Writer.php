<?php declare(strict_types=1);

include __DIR__ . '/WriterInterface.php';

class Writer implements WriterInterface
{
    private const OUTPUT_PATH = __DIR__ . '/output';

    public function write(array $data, string $name): void
    {
        if (!is_dir(self::OUTPUT_PATH) && !mkdir($concurrentDirectory = self::OUTPUT_PATH) && !is_dir($concurrentDirectory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
        }

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