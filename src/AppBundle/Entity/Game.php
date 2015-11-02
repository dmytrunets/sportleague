<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity
 */
class Game
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
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime", nullable=false)
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity="Stadium")
     * @ORM\JoinColumn(name="stadium_id", referencedColumnName="id")
     */
    private $stadium;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="organizer_team_id", referencedColumnName="id", nullable=true)
     */
    private $organizerTeam;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="guest_team_id", referencedColumnName="id", nullable=true)
     */
    private $guestTeam;

    /**
     * @var string
     *
     * @ORM\Column(name="score", type="string", length=45, nullable=false)
     */
    private $score;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="winner_team_id", referencedColumnName="id", nullable=true)
     */
    private $winnerTeam;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="looser_team_id", referencedColumnName="id", nullable=true)
     */
    private $looserTeam;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=true)
     */
    private $statusId;

    /**
     * @ORM\ManyToOne(targetEntity="Tournament", fetch="EAGER", inversedBy="games")
     */
    private $tournament;
}
