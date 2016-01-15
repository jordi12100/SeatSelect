<?php

namespace Cinema;

class SeatManager
{
    /**
     * @var int
     */
    protected $amountOfSeats;

    /**
     * @var array
     */
    protected $chosenSeats = [];

    /**
     * @param int $amountOfSeats
     * @param array $chosenSeats
     */
    public function __construct($amountOfSeats, $chosenSeats = [])
    {
        $this->amountOfSeats = $amountOfSeats;
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
        return array_diff(
            range(1, $this->amountOfSeats),
            $this->chosenSeats
        );
    }

    /**
     * @param array $seats
     * @return array
     */
    protected function reserveSeats($seats)
    {
        foreach ($seats as $seat) {
            if (in_array($seat, $this->chosenSeats)) {
                throw new \InvalidArgumentException('Seat already reserved');
            }

            $this->chosenSeats[] = $seat;
        }

        return $seats;
    }
}
