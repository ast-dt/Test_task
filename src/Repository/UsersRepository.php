<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }

    public function findUserByLoginAndPassword($login, $password): ?Users
    {
        try {
            return $this->createQueryBuilder('u')
                ->andWhere('u.login  = :login and u.pswd = :pass')
                ->setParameter('login', $login)
                ->setParameter('pass', $password)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    public function findUserById($userId): ?Users
    {
        try {
            return $this->createQueryBuilder('u')
                ->andWhere('u.userId = :user')
                ->setParameter('user', $userId)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    public function findActiveUsers()
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.state = 0')
            ->getQuery()
            ->getArrayResult();
    }
}
