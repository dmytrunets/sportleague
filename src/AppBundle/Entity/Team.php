<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\TeamRepository")
 */
class Team
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="LocationAddress", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\JoinTable(name="location_address")
     */
    private $address;

    /**
     * @ORM\ManyToMany(targetEntity="Stadium", inversedBy="teams")
     * @ORM\JoinTable(name="stadium_to_team")
     */
    private $stadiums;

    /**
     * @ORM\ManyToMany(targetEntity="Player", inversedBy="teams")
     * @ORM\JoinTable(name="player_to_team")
     */
    private $players;

    /**
     * @return Stadium[]
     */
    public function getStadiums()
    {
        return $this->stadiums;
    }

    /**
     * @param Stadium $stadium
     */
    public function setStadium($stadium)
    {
        $this->stadiums[] = $stadium;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return LocationAddress
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param LocationAddress $address
     */
    public function setAddress(LocationAddress $address)
    {
        $this->address = $address;
    }

    /**
     * @return Player[]
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param Player $player
     */
    public function setPlayer(Player $player)
    {
        $this->players[] = $player;
    }
}
