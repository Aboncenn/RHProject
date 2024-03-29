<?php

namespace App\Repository;

use App\Entity\UserByCampagne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserByCampagne|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserByCampagne|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserByCampagne[]    findAll()
 * @method UserByCampagne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserByCampagneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserByCampagne::class);
    }

    // /**
    //  * @return UserByCampagne[] Returns an array of UserByCampagne objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserByCampagne
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
