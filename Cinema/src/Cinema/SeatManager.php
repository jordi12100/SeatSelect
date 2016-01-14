<?php

namespace Cinema;

class SeatManager
{
    /**
     * @var array
     */
    protected $seats = [];

    public function __construct($seats)
    {
        $this->seats = $seats;
    }

    public function giveSeatNumbers($visitors)
    {

    }
}
