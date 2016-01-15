<?php

namespace CinemaTest;

use Cinema\SeatManager;

class SeatManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testNoRemainingSeats()
    {
        $seatManager = new SeatManager(10, range(1, 10));
        $this->assertNull($seatManager->getSeatNumbers(3));
    }

    public function testAllSeatsAvailable()
    {
        $seatManager = new SeatManager(10, []);
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
            // Those are lucky
            [3, 10, [4, 5, 6], [1, 2, 3]],
            [3, 10, [1, 2, 3, 7, 8, 9], [4, 5, 6]],
            [1, 10, [1, 2, 3, 4, 6, 7, 8, 9, 10], [5]],

            // 2 | 1
            [3, 10, [1, 2, 4, 5, 6, 9, 10], [7, 8, 3]],

            // odd numbers
            [2, 10, [1, 2, 4, 5, 6, 9, 10], [7, 8]],
            [2, 10, [1, 2, 4, 5, 6, 7, 9, 10], [3, 8]],

            // Can't place them all
            [4, 10, [1, 2, 4, 5, 6, 9, 10], null],
            [1, 10, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], null],

            // Extreme case
            [20, 40, [5, 10, 12, 20, 24, 28, 30, 35, 40], [13, 14, 15, 16, 17, 18, 19, 1, 2, 3, 4, 6, 7, 8, 9, 31, 32, 33, 34, 11]],
        ];
    }
}
