<?php declare(strict_types=1);

include __DIR__ . '/DataLoaderInterface.php';
include __DIR__ . '/InputData.php';

class Loader implements DataLoaderInterface
{
    public function getFilesToProcess(): array
    {
        $filesInDirectory = scandir(__DIR__ . '/src', SCANDIR_SORT_ASCENDING);
        $filesToProcess = [];

        foreach($filesInDirectory as $file) {
            if (strpos($file,'.in') !== false) {
                $filesToProcess[] = $file;
            }
        }

        return $filesToProcess;
    }
    public function printFilesToProcess(array $files): void
    {
        for($i=0, $count = count($files); $i < $count; $i++){
            echo $i . ' ' . $files[$i] . PHP_EOL;
        }
        echo '"a" for all files' . PHP_EOL;
    }

    public function load(string $file): InputData
    {
        if (!is_file($file)) {
            throw new Exception('not a file');
        }

        $name = $this->stripNameFromPath($file);

        $handler = fopen($file, 'r');

        $config = $this->getConfigFromFile($handler);
        $data = $this->getDataFromFile($handler);

        fclose($handler);

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