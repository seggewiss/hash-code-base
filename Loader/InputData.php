<?php declare(strict_types=1);

class InputData
{
    /**
     * @var string
     */
    private $config;

    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $name;

    public function __construct(string $config, array $data, string $name)
    {
        $this->config = $config;
        $this->data = $data;
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}