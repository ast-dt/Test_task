<?php

namespace App\Repository;

use App\Entity\StateList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method StateList|null find($id, $lockMode = null, $lockVersion = null)
 * @method StateList|null findOneBy(array $criteria, array $orderBy = null)
 * @method StateList[]    findAll()
 * @method StateList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StateList::class);
    }


    public function findActiveState(): ?StateList
    {
        try {
            return $this->createQueryBuilder('s')
                ->andWhere('s.stateId = 0')
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    public function findInactiveState(): ?StateList
    {
        try {
            return $this->createQueryBuilder('r')
                ->andWhere('r.stateId = 1')
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
