<?php declare(strict_types=1);

echo 'Hacking Pentagon......' . PHP_EOL;

include __DIR__ . '/Loader.php';
include __DIR__ . '/Processor.php';
include __DIR__ . '/Writer.php';

$loader = new Loader();
$processor = new Processor();
$writer = new Writer();

$unprocessedData = $loader->load(Loader::SMALL_FILE);
$processedData =$processor->process($unprocessedData);
$writer->write($processedData, $unprocessedData->getName());

echo 'Zipping files:' . PHP_EOL;
exec('zip -r output/source' . time() .'.zip *.php');
echo 'Files zipped!' . PHP_EOL;

echo 'Success :)';