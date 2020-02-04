<?php


namespace App\Entity;


class Mission
{
    /**
     * @var Rover[]
     */
    private $rovers = [];

    /**
     * @var Area
     */
    private $area;

    /**
     * @param string $inputfile
     * @throws \Exception
     */
    public function createFromFile(string $inputfile):void
    {
        // Function needs validators; Outside of assignment scope

        $handle = fopen(__DIR__ . '/../../' . $inputfile, 'r');

        // Get the area of the exploration field
        $areaString = trim(fgets($handle));

        if (!$areaString) throw (new \Exception('File not found or empty'));

        $this->area = new Area($areaString);

        while (!feof($handle) ) {
            $this->rovers[] = new Rover(
                trim(fgets($handle)),
                trim(fgets($handle))
            );
        }

        fclose($handle);
    }

    /**
     * @return Rover[]
     */
    public function getRovers():array
    {
        return $this->rovers;
    }

    /**
     * @return Area
     */
    public function getArea():Area
    {
        return $this->area;
    }
}