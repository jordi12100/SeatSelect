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

    /**
     * @dataProvider seatsProvider
     */
    public function testAvailable($visitors, $seats, $chosenSeats, $expectation)
    {
        $seatManager = new SeatManager($seats, $chosenSeats);
        $this->assertEquals($expectation, $seatManager->getSeatNumbers($visitors));
    }

    /**
     * visitors | seats | chosen seats | expectation
     * @return array
     */
    public function seatsProvider()
    {
        return [
            3, range(1, 10), [4, 5, 6], [1, 2, 3],
            3, range(1, 10), [1, 2, 3, 7, 8, 9], [4, 5, 6],
            3, range(1, 10), [1, 2, 3, 4, 5, 6, 7, 8], [9, 10, null],
            1, range(1, 10), [1, 2, 3, 4, 6, 7, 8, 9, 10], [5],
            3, range(1, 10), [1, 2, 4, 5, 6, 9, 10], [7, 8, 3],
            2, range(1, 10), [1, 2, 4, 5, 6, 9, 10], [7, 8],
            4, range(1, 10), [1, 2, 4, 5, 6, 9, 10], [7, 8, 3, null],
            2, range(1, 10), [1, 2, 4, 5, 6, 7, 9, 10], [3, 8],
        ];
    }
}
