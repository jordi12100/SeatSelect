<?php

namespace Cinema\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cinema", options={"collate"="utf8_general_ci"})
 */
class Cinema
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
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Cinema\Model\Seat", mappedBy="cinema")
     *
     * @var ArrayCollection|Seat[]
     */
    protected $chosenSeats;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    protected $amountOfSeats;

    /**
     * @param string $name
     * @param int $amountOfSeats
     */
    public function __construct($name, $amountOfSeats)
    {
        $this->name = $name;
        $this->amountOfSeats = $amountOfSeats;

        $this->chosenSeats = new ArrayCollection;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Seat[]|ArrayCollection
     */
    public function getChosenSeats()
    {
        return $this->chosenSeats;
    }

    /**
     * @return int
     */
    public function getAmountOfSeats()
    {
        return $this->amountOfSeats;
    }
}
