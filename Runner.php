<?php declare(strict_types=1);

include __DIR__ . '/Loader.php';
include __DIR__ . '/Processor.php';
include __DIR__ . '/Writer.php';

$loader = new Loader();
$processor = new Processor();
$writer = new Writer();

echo 'Process data......' . PHP_EOL;
$unprocessedData = $loader->load(Loader::SMALL_FILE);
$processedData =$processor->process($unprocessedData);
$writer->write($processedData, $unprocessedData->getName());
echo 'Process finished!' . PHP_EOL . PHP_EOL;

echo 'Zipping files......' . PHP_EOL;
$writer->zip();
echo 'Files zipped!' . PHP_EOL;

echo 'Success!';