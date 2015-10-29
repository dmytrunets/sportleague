<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tournament
 *
 * @ORM\Table(name="tournament")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\TournamentRepository")
 */
class Tournament
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="date", nullable=false)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finish_date", type="date", nullable=false)
     */
    private $finishDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="count_player", type="integer", nullable=false)
     */
    private $countPlayer;

    /**
     * @var integer
     *
     * @ORM\Column(name="game_time", type="integer", nullable=false)
     */
    private $gameTime;

    /**
     * @ORM\ManyToMany(targetEntity="Team", inversedBy="tournaments")
     * @ORM\JoinTable(name="team_to_tournament")
     */
    private $teams;

    /**
     * @ORM\OneToMany(targetEntity="Game", mappedBy="tournament", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\JoinTable(name="game")
     */
    private $games;

    /**
     * @return int
     */
    public function getCountPlayer()
    {
        return $this->countPlayer;
    }

    /**
     * @param int $countPlayer
     */
    public function setCountPlayer($countPlayer)
    {
        $this->countPlayer = $countPlayer;
    }

    /**
     * @return \DateTime
     */
    public function getFinishDate()
    {
        return $this->finishDate;
    }

    /**
     * @param \DateTime $finishDate
     */
    public function setFinishDate($finishDate)
    {
        $this->finishDate = $finishDate;
    }

    /**
     * @return int
     */
    public function getGameTime()
    {
        return $this->gameTime;
    }

    /**
     * @param int $gameTime
     */
    public function setGameTime($gameTime)
    {
        $this->gameTime = $gameTime;
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
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Add team
     *
     * @param Team $team
     */
    public function addTeam(Team $team)
    {
        $this->teams[] = $team;
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Add game
     *
     * @param Game $game
     */
    public function addGame(Game $game)
    {
        $this->games[] = $game;
    }

    /**
     * Get games
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGames()
    {
        return $this->games;
    }
}
