<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\GameRepository")
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

    /**
     * @return mixed
     */
    public function getGuestTeam()
    {
        return $this->guestTeam;
    }

    /**
     * @param mixed $guestTeam
     */
    public function setGuestTeam($guestTeam)
    {
        $this->guestTeam = $guestTeam;
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
     * @return mixed
     */
    public function getLooserTeam()
    {
        return $this->looserTeam;
    }

    /**
     * @param mixed $looserTeam
     */
    public function setLooserTeam($looserTeam)
    {
        $this->looserTeam = $looserTeam;
    }

    /**
     * @return mixed
     */
    public function getOrganizerTeam()
    {
        return $this->organizerTeam;
    }

    /**
     * @param mixed $organizerTeam
     */
    public function setOrganizerTeam($organizerTeam)
    {
        $this->organizerTeam = $organizerTeam;
    }

    /**
     * @return string
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param string $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return mixed
     */
    public function getStadium()
    {
        return $this->stadium;
    }

    /**
     * @param mixed $stadium
     */
    public function setStadium($stadium)
    {
        $this->stadium = $stadium;
    }

    /**
     * @return int
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * @param int $statusId
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;
    }

    /**
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * @param mixed $tournament
     */
    public function setTournament($tournament)
    {
        $this->tournament = $tournament;
    }

    /**
     * @return mixed
     */
    public function getWinnerTeam()
    {
        return $this->winnerTeam;
    }

    /**
     * @param mixed $winnerTeam
     */
    public function setWinnerTeam($winnerTeam)
    {
        $this->winnerTeam = $winnerTeam;
    }


}
