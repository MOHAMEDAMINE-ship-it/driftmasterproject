<?php

namespace App\Repository;

use App\Entity\Vihecule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vihecule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vihecule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vihecule[]    findAll()
 * @method Vihecule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ViheculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vihecule::class);
    }

    // /**
    //  * @return Vihecule[] Returns an array of Vihecule objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vihecule
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
