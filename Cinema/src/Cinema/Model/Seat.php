<?php

namespace Cinema\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="seat", options={"collate"="utf8_general_ci"})
 */
class Seat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    protected $number;

    /**
     * @ORM\ManyToOne(targetEntity="Cinema\Model\Cinema", inversedBy="chosenSeats")
     * @ORM\JoinColumn(name="cinemaId", referencedColumnName="id")
     * @var Cinema|null
     */
    protected $cinema;

    /**
     * @param Cinema|null $cinema
     * @param int $number
     */
    public function __construct(Cinema $cinema, $number)
    {
        $this->cinema = $cinema;
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return Cinema|null
     */
    public function getCinema()
    {
        return $this->cinema;
    }
}
