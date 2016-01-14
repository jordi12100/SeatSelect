<?php

namespace CinemaTest;

use Cinema\SeatManager;

class SeatManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testNoRemainingSeats()
    {
        $seatManager = new SeatManager(range(1, 10), range(1, 10));
        $this->assertNull($seatManager->getSeatNumbers(3));
    }

    public function testAllSeatsAvailable()
    {
        $seatManager = new SeatManager(range(1, 10));
        $this->assertEquals([1, 2, 3], $seatManager->getSeatNumbers(3));
    }

    public function testAvailable()
    {
        $seatManager = new SeatManager(range(1, 10));
        $this->assertEquals([1, 2, 3], $seatManager->getSeatNumbers(3));
    }
}
