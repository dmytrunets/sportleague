<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/tournament/{tournament_id}", name="tournament_view", defaults={"tournament_id"="1"})
     */
    public function tournamentViewAction(Request $request)
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
}
