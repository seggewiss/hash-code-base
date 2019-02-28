<?php declare(strict_types=1);

include __DIR__ . '/WriterInterface.php';

class Writer implements WriterInterface
{
    private const OUTPUT_PATH = __DIR__ . '/../output';

    public function write(array $data, string $name): void
    {
        if (!is_dir(self::OUTPUT_PATH) && !mkdir($concurrentDirectory = self::OUTPUT_PATH) && !is_dir($concurrentDirectory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
        }

        $handler = fopen(__DIR__  . '/../output/' . $name . time() . '.out', 'w');
        fwrite($handler, count($data) . PHP_EOL);
        foreach($data as $slide){

            foreach($slide as $picture) {
                fwrite($handler, $picture['id'].' ');
            }

            fwrite($handler, PHP_EOL);
        }
        fclose($handler);
    }

    public function zip(): void
    {
        exec('zip -r output/source' . time() .'.zip *.php Loader/*.php Processor/*.php Writer/*.php');
    }
}