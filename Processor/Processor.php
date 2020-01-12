<?php declare(strict_types=1);

include __DIR__ . '/ProcessorInterface.php';

class Processor implements ProcessorInterface
{
    public function process(InputData $inputObject): array
    {
        $currentSlice = 0;
        $maxSlices = $inputObject->getConfig()[0];

        $flippedData = array_flip($inputObject->getData());
        krsort($flippedData);
        $sortedData = array_flip($flippedData);

        $pizzen = [];
        foreach ($sortedData as $key => $pizza) {
            $pizza = (int) $pizza;
            if (($currentSlice + $pizza) < $maxSlices) {
                $currentSlice += $pizza;
                $pizzen[] = $key;
            }
        }

        return $pizzen;
    }
}