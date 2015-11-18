<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class GameRepository extends EntityRepository
{
    public function getLastGames($tournamentId)
    {
        return $this->createQueryBuilder('g')
            ->innerJoin('g.tournament', 't')
            ->orderBy('g.time', 'ASC')
            ->where('t.id = :tournament_id')
            ->setParameter(':tournament_id', $tournamentId)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function getNextGames($tournamentId)
    {
        return $this->createQueryBuilder('g')
            ->innerJoin('g.tournament', 't')
            ->orderBy('g.time', 'ASC')
            ->where('t.id = :tournament_id')
            ->setParameter(':tournament_id', $tournamentId)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }
}
