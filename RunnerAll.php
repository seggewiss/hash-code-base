<?php declare(strict_types=1);

include __DIR__ . '/Loader.php';
include __DIR__ . '/Processor.php';
include __DIR__ . '/Writer.php';

$loader = new Loader();
$processor = new Processor();
$writer = new Writer();

$files = [
    Loader::EXAMPLE_FILE,
    Loader::SMALL_FILE,
    Loader::MEDIUM_FILE,
    Loader::BIG_FILE
];

echo 'Process data......' . PHP_EOL;
foreach($files as $file){
    $unprocessedData = $loader->load($file);

    echo "Process data {$unprocessedData->getName()} ......" . PHP_EOL;
    $processedData =$processor->process($unprocessedData);

    echo "Write data {$unprocessedData->getName()} ......" . PHP_EOL . PHP_EOL;
    $writer->write($processedData, $unprocessedData->getName());
}
echo 'Process finished!' . PHP_EOL . PHP_EOL;

echo 'Zipping files......' . PHP_EOL;
$writer->zip();
echo 'Files zipped!' . PHP_EOL;

echo 'Success!';