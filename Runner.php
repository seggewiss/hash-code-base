<?php declare(strict_types=1);

const INPUT_FILE_PREFIX = __DIR__ . '/src/';

include __DIR__ . '/Loader.php';
include __DIR__ . '/Processor.php';
include __DIR__ . '/Writer.php';

$loader = new Loader();
$processor = new Processor();
$writer = new Writer();
$filesToProcess = $loader->getFilesToProcess();

echo 'Choose files to process:' . PHP_EOL;
$loader->printFilesToProcess($filesToProcess);
$userInput = readline();

echo 'Processing data......' . PHP_EOL;

if ($userInput === 'a'){
    foreach($filesToProcess as $file) {
        $unprocessedData = $loader->load(INPUT_FILE_PREFIX . $file);
        $processedData =$processor->process($unprocessedData);
        $writer->write($processedData, $unprocessedData->getName());
    }
} else {
    $userInput = (int) $userInput;
    $unprocessedData = $loader->load(INPUT_FILE_PREFIX . $filesToProcess[$userInput]);
    $processedData =$processor->process($unprocessedData);
    $writer->write($processedData, $unprocessedData->getName());
}

echo 'Process finished!' . PHP_EOL . PHP_EOL;

echo 'Zipping files......' . PHP_EOL;
$writer->zip();
echo 'Files zipped!' . PHP_EOL;

echo 'Success!';