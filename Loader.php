<?php declare(strict_types=1);

include __DIR__ . '/DataLoaderInterface.php';
include __DIR__ . '/InputData.php';

class Loader implements DataLoaderInterface
{
    public const EXAMPLE_FILE = __DIR__ . '/src/a_example.in';
    public const SMALL_FILE = __DIR__ . '/src/b_small.in';
    public const MEDIUM_FILE = __DIR__ . '/src/c_medium.in';
    public const BIG_FILE = __DIR__ . '/src/d_big.in';

    public function load(string $file): InputData
    {
        if (!is_file($file)) {
            throw new Exception('not a file');
        }

        $name = $this->stripNameFromPath($file);

        $hanlder = fopen($file, 'r');

        $config = $this->getConfigFromFile($hanlder);
        $data = $this->getDataFromFile($hanlder);

        fclose($hanlder);

        return new InputData($config, $data, $name);
    }

    private function getConfigFromFile($handler): array
    {
        $rawConfig = fgets($handler);
        return explode(' ', $rawConfig);
    }

    private function getDataFromFile($handler): array
    {
        $rawData = [];

        while(($line = fgets($handler)) !== false) {
            $lineData = [];
            for($i=0, $max = strlen($line)-1; $i < $max ; $i++) {
                $lineData[] = $line[$i];
            }
            $rawData[] = $lineData;
        }

        return $rawData;
    }

    private function stripNameFromPath(string $path): string
    {
        $strippedPath = substr(strrchr($path, '/'), 1);
        return substr($strippedPath,0, strpos($strippedPath,'.'));
    }

}