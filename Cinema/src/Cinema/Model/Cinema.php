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
    protected $seats;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection|Seat[]
     */
    public function getSeats()
    {
        return $this->seats;
    }
}
