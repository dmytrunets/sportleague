<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GameStatus
 *
 * @ORM\Table(name="game_status")
 * @ORM\Entity
 */
class GameStatus
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
     * @ORM\Column(name="desc", type="string", length=255, nullable=true)
     */
    private $desc;


}
