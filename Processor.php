<?php declare(strict_types=1);

include __DIR__ . '/ProcessorInterface.php';

class Processor implements ProcessorInterface
{
    private $data;
    private $outputData = [
        0 => [0]
    ];

    public function process(InputData $data): array
    {
        // TODO: Magic
        $maxRows = $data->getConfig()[0];
        $maxColumns = $data->getConfig()[1];
        $minIngredients = $data->getConfig()[2];
        $maxCellsProSlice = $data->getConfig()[3];

        $currentStartX = 0;
        $currentStartY = 0;

        $currentEndX = 0;
        $currentEndY = 0;

        $this->data = $data->getData();

        $this->deleteSlices(0, 0, 1, 1);

        return $this->outputData;
    }

    private function deleteSlices(int $startX, int $startY, int $endX, int $endY): void
    {
        for($row = $startX; $row <= $endX; $row++)
        {
            for($col = $startY; $col <= $endY; $col++)
            {
                $this->data[$row][$col] = 'X';
            }
        }
        $this->outputData[] = [$startX, $startY, $endX, $endY];
        $this->outputData[0][0]++;
    }
}