<?php

namespace App\Tests\Entity;

use App\Entity\Area;
use PHPUnit\Framework\TestCase;

class AreaTest extends TestCase
{
    public function testReturnXandYfromArea()
    {
        $area = new Area('10 5');

        $this->assertEquals(10, $area->getAreaX());
        $this->assertEquals(10, $area->getAreaX());
    }
}