<?php declare(strict_types=1);

include __DIR__ . '/ProcessorInterface.php';

class Processor implements ProcessorInterface
{
    private $data;
    private $outputData = [
        0 => [0]
    ];

    public function process(InputData $inputObject): array
    {
        $data = $inputObject->getData();
        $slides = [];
        $slideIndex = 0;
        $lastVIndex = -1;

        for($i=0, $max = count($data); $i < $max; $i++) {
            if ($data[$i]['type'] === 'H') {
                $slides[$slideIndex][] = $data[$i];
                $slideIndex++;
                continue;
            }

            if ($lastVIndex === -1) {
                $slides[$slideIndex] = [];
                $slides[$slideIndex][] = $data[$i];

                $lastVIndex = $slideIndex;
                $slideIndex++;
            } else {
                $slides[$lastVIndex][] = $data[$i];
                $lastVIndex = -1;
            }
        }

        return $slides;
    }
}