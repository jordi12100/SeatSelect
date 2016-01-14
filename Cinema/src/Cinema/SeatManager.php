<?php

namespace Cinema;

class SeatManager
{
    /**
     * @var array
     */
    protected $seats = [];

    /**
     * @param array $seats
     * @param array $chosenSeats
     */
    public function __construct($seats, $chosenSeats = [])
    {
        $this->seats = $seats;
        $this->chosenSeats = $chosenSeats;
    }

    /**
     * @param int $visitors
     * @return array|null
     */
    public function getSeatNumbers($visitors)
    {
        if (count($this->getAvailableSeats())) {
            return null;
        }
    }

    /**
     * @return array
     */
    protected function getAvailableSeats()
    {
        return array_diff($this->seats, $this->chosenSeats);
    }
}
