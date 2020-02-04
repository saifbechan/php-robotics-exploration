<?php


namespace App\Entity;


class Rover
{
    /**
     * @var string
     */
    private $start;

    /**
     * @var string
     */
    private $steps;

    /**
     * @var string[][]
     */
    private $positions = [];

    /**
     * @var string[][]
     */
    private $directionMap = [
        'L' => [
            'N' => 'W', 'W' => 'S', 'S' => 'E', 'E' => 'N'
        ],
        'R' => [
            'N' => 'E', 'E' => 'S', 'S' => 'W', 'W' => 'N'
        ]
    ];

    /**
     * @var string[][]
     */
    private $movementMap = [
        'N' => [1, 1],
        'E' => [0, 1],
        'S' => [1, -1],
        'W' => [0, -1]
    ];

    function __construct(string $start, string $steps)
    {
        $this->start = $start;
        $this->steps = $steps;

        $this->addPosition($this->getStartAsArray());
    }

    public function explore(Area $area):void
    {
        foreach($this->getStepsAsArray() as $step)
        {
            $nextStep = $this->getNextStep($this->getLastPosition(), $step);

            // Outside of the scope of current assignment
            $this->assertPositionWithinArea($nextStep, $area);

            $this->addPosition($nextStep);
        }
    }

    private function getNextStep(array $position, string $step):array
    {
        switch($step) {
            case 'L':
            case 'R':
                $position[2] = $this->directionMap[$step][$position[2]];
                break;
            case 'M':
                list($idx, $inc) = $this->movementMap[$position[2]];
                $position[$idx] = $position[$idx] + $inc;
                break;
        }
        return $position;
    }

    private function assertPositionWithinArea(array $position, Area $area):bool
    {
        if ($position[0] > $area->getAreaX() || $position[1] > $area->getAreaY())
        {
            return false;
        }
        return true;
    }

    private function addPosition(array $position):void
    {
        $this->positions[] = $position;
    }

    /**
     * @return string[]
     */
    private function getStartAsArray():array
    {
        return explode(' ', $this->start);
    }

    /**
     * @return string[]
     */
    private function getStepsAsArray():array
    {
        return str_split($this->steps);
    }

    /**
     * @return array[][]
     */
    public function getLastPosition():array
    {
        return $this->positions[sizeof($this->positions) - 1];
    }
}