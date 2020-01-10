<?php declare(strict_types=1);

include __DIR__ . '/ProcessorInterface.php';

class Processor implements ProcessorInterface
{
    public function process(InputData $inputObject): array
    {
        $currentSlice = 0;
        $maxSlices = $inputObject->getConfig()[0];

        $pizzen = [];
        foreach ($inputObject->getData() as $key => $pizza) {
            $pizza = (int) $pizza;
            if (($currentSlice + $pizza) < $maxSlices) {
                $currentSlice += $pizza;
                $pizzen[] = $key;
            }
        }

        return $pizzen;
    }
}