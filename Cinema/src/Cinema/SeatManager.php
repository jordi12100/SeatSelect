<?php

namespace Cinema;

class SeatManager
{
    /**
     * @var array
     */
    protected $seats = [];

    /**
     * @var array
     */
    protected $chosenSeats = [];

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
        $seatNumbers = $this->getBestSeatNumbers($visitors);
        return count($seatNumbers) === $visitors ? $seatNumbers : null;
    }

    /**
     * @param int $visitors
     * @param null|int $seats
     * @return array
     */
    protected function getBestSeatNumbers($visitors, $seats = null)
    {
        $seats = $seats ?: $visitors;

        $bestSeats = $this->findBestSeatsFor($this->getAvailableSeats(), $seats);
        if (count($bestSeats) !== $visitors && count($this->getAvailableSeats()) > 0) {
            $bestSeats = array_merge($bestSeats, $this->getBestSeatNumbers($seats, $visitors-1 ?: 1));
        }

        return $bestSeats;
    }

    /**
     * @param array $availableSeats
     * @param int $visitors
     * @return null
     */
    protected function findBestSeatsFor($availableSeats, $visitors)
    {
        foreach ($availableSeats as $key => $availableSeat) {
            $start = $key + 1;
            $end = $start + ($visitors-1);

            if (!$this->isRangeAvailable($start, $end)) {
                continue;
            }

            $this->reserveSeats(range($start, $end));
            return range($start, $end);
        }

        return [];
    }

    /**
     * @param int $start
     * @param int $end
     * @return bool
     */
    protected function isRangeAvailable($start, $end)
    {
        for ($i = $start; $i <= $end; $i++) {
            if (!$this->isAvailable($i)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param int $seat
     * @return bool
     */
    protected function isAvailable($seat)
    {
        return in_array($seat, $this->getAvailableSeats());
    }

    /**
     * @return array
     */
    protected function getAvailableSeats()
    {
        return array_diff($this->seats, $this->chosenSeats);
    }

    /**
     * @param array $seats
     * @return array
     */
    protected function reserveSeats($seats)
    {
        foreach ($seats as $seat) {
            $this->chosenSeats[] = $seat;
        }

        return $seats;
    }
}
