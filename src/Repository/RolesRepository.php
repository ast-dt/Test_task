<?php

namespace App\Repository;

use App\Entity\Roles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Roles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Roles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Roles[]    findAll()
 * @method Roles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RolesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Roles::class);
    }

    public function findAdminRole(): ?Roles
    {
        try {
            return $this->createQueryBuilder('r')
                ->andWhere('r.roleId = 0')
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    public function findUserRole(): ?Roles
    {
        try {
            return $this->createQueryBuilder('r')
                ->andWhere('r.roleId = 1')
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
