<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class WebController extends Controller
{
    /**
     * @Template()
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();

        $teams = $this->getDoctrine()->getRepository('AppBundle\Entity\Team')
            ->findAll();

        $games = $this->getDoctrine()->getRepository('AppBundle\Entity\Game')
            ->findAll();

        return $this->render('AppBundle:Web:profile.html.twig', array('teams' => $teams, 'games' => $games));
    }

    /**
     * @Route("/tournament/{tournament_id}", name="tournament_view", defaults={"tournament_id"="1"})
     */
    public function testtournamentViewAction(Request $request)
    {
        $tournamentRepo = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Tournament');

        $tournament = $tournamentRepo
            ->createQueryBuilder('t')
            ->select('t', 'g', 'tm', 'a', 'st', 'pl', 'gt', 'ot', 'wt', 'lt')
            ->leftJoin('t.teams', 'tm')
            ->leftJoin('tm.address', 'a')
            ->leftJoin('tm.stadiums', 'st')
            ->leftJoin('tm.players', 'pl')
            ->leftJoin('t.games', 'g')
            ->leftJoin('g.guestTeam', 'gt')
            ->leftJoin('g.organizerTeam', 'ot')
            ->leftJoin('g.winnerTeam', 'wt')
            ->leftJoin('g.looserTeam', 'lt')
            ->where('t.id = 1')
            ->getQuery()
            ->getArrayResult();

        var_dump($tournament);

        $teamRepo = $this->getDoctrine()->getManager()->getRepository('AppBundle\Entity\Team');
        $team = $teamRepo
            ->createQueryBuilder('tm')
            ->select('tm', 'a', 'st', 'pl', 'lc', 'lr', 'lci')
            ->leftJoin('tm.address', 'a')
            ->leftJoin('tm.stadiums', 'st')
            ->leftJoin('tm.players', 'pl')
            ->leftJoin('a.locationCountry', 'lc')
            ->leftJoin('a.locationRegion', 'lr')
            ->leftJoin('a.locationCity', 'lci')
            ->where('tm.id = 1')
            ->getQuery()
            ->getArrayResult();

//        var_dump($team);

        return new Response('OK', 200);
    }

    /**
     * @Template()
     * @Route("/game/view/{game_id}", name="game_view")
     */
    public function gameViewAction(Request $request)
    {
        $data = array();
        return $this->render('AppBundle:Web:game_view.html.twig', array('games' => $data));
    }

    /**
     * @Template()
     * @Route("/team/view/{team_id}", name="team_view")
     */
    public function teamViewAction(Request $request)
    {
        $data = array();
        return $this->render('AppBundle:Web:team_view.html.twig', array('games' => $data));
    }

    /**
     * @Template()
     * @Route("/league/view/{league_id}", name="league_view")
     */
    public function tournamentViewAction(Request $request)
    {
        $leagueId = $request->get('league_id');

        $lastGames = $this->getDoctrine()->getRepository('AppBundle\Entity\Game')
            ->getLastGames($leagueId);

        $nextGames = $this->getDoctrine()->getRepository('AppBundle\Entity\Game')
            ->getNextGames($leagueId);

        $teams = $this->getDoctrine()
            ->getConnection()
            ->fetchAll("SELECT *
                    FROM team as t
                    LEFT JOIN (
                    SELECT winner_team_id, COUNT(winner_team_id) * 3 AS score
                    FROM game
                    WHERE tournament_id = {$leagueId}
                    GROUP BY winner_team_id
                    ) as g
                    ON t.id = g.winner_team_id
                    ORDER BY score DESC, t.name ASC");

        return $this->render('AppBundle:Web:league_view.html.twig', array('teams' => $teams, 'last_games' => $lastGames, 'next_games' => $nextGames));
    }
}
