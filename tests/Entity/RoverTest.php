<?php


namespace App\Tests\Entity;


use App\Entity\Area;
use App\Entity\Rover;
use PHPUnit\Framework\TestCase;

class RoverTest extends TestCase
{
    public function testAddStartPositionToArrayOnInit()
    {
        $rover = new Rover('1 2 N', 'LL');

        $this->assertEquals([1, 2, 'N'], $rover->getLastPosition());
    }

    public function testCorrectLeftTurnAndStepForward()
    {
        $rover = new Rover('1 2 N', 'LM');

        $rover->explore(new Area('5 5'));

        $this->assertEquals([0, 2, 'W'], $rover->getLastPosition());
    }

    public function testCorrectExploration()
    {
        $rover = new Rover('3 3 E', 'MMRMMRMRRM');

        $rover->explore(new Area('5 5'));

        $this->assertEquals([5, 1, 'E'], $rover->getLastPosition());
    }
}