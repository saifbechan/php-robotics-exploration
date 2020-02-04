<?php


namespace App\Entity;


class Area
{
    /**
     * @var string
     */
    private $area;

    /**
     * @var int[]
     */
    private $areaAsArray;

    function __construct(string $area)
    {
        $this->area = $area;
        $this->areaAsArray = explode(' ', $area);
    }

    public function getAreaX()
    {
        return $this->areaAsArray[0];
    }

    public function getAreaY()
    {
        return $this->areaAsArray[1];
    }
}