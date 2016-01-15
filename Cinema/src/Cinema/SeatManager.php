<?php

namespace Cinema;

class SeatManager
{
    /**
     * @var array
     */
    protected $availableSeats = [];

    /**
     * @param int $amountOfSeats
     * @param array $chosenSeats
     */
    public function __construct($amountOfSeats, $chosenSeats = [])
    {
        $this->availableSeats = array_diff(
            range(1, $amountOfSeats),
            $chosenSeats
        );
    }

    /**
     * @param int $visitors
     * @return array|null
     */
    public function getSeatNumbers($visitors)
    {
        if ($visitors > count($this->availableSeats)) {
            return null;
        }

        $seatNumbers = $this->getBestSeatNumbers($visitors);
        return count($seatNumbers) === $visitors ? $seatNumbers : null;
    }

    /**
     * @param int $visitors
     * @return array
     */
    protected function getBestSeatNumbers($visitors)
    {
        $find = $visitors;

        $seatNumbers = [];
        while (count($this->availableSeats) > 0) {
            $bestSeats = $this->findBestSeatsFor($find);
            $seatNumbers = array_merge($seatNumbers, $bestSeats);

            $find = count($bestSeats)
                ? $visitors - count($seatNumbers)
                : $find - 1;

            if (count($seatNumbers) === $visitors) {
                break;
            }
        }

        return $seatNumbers;
    }

    /**
     * @param int $visitors
     * @return null
     */
    protected function findBestSeatsFor($visitors)
    {
        $skipSeats = 0;
        foreach ($this->availableSeats as $key => $availableSeat) {
            $start = $key + 1;
            $end = $start + ($visitors-1);

            if ($skipSeats === $start) {
                $skipSeats -= 1;
                continue;
            }

            $unavailableSeat = $this->getLastUnavailableInRange($start, $end);
            if ($unavailableSeat !== null) {
                $skipSeats = $unavailableSeat;
                continue;
            }

            $seats = range($start, $end);
            $this->reserveSeats($seats);
            return $seats;
        }

        return [];
    }

    /**
     * @param int $start
     * @param int $end
     * @return bool
     */
    protected function getLastUnavailableInRange($start, $end)
    {
        for ($i = $end; $i >= $start; $i--) {
            if (!$this->isAvailable($i)) {
                return $i;
            }
        }

        return null;
    }

    /**
     * @param int $seat
     * @return bool
     */
    protected function isAvailable($seat)
    {
        return in_array($seat, $this->availableSeats);
    }

    /**
     * @param array $seats
     * @return array
     * @throws \InvalidArgumentException
     */
    protected function reserveSeats($seats)
    {
        foreach ($seats as $seat) {
            if (!isset($this->availableSeats[$seat-1])) {
                throw new \InvalidArgumentException('Seat already reserved');
            }
            unset($this->availableSeats[$seat-1]);
        }

        return $seats;
    }
}
