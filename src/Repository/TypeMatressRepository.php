<?php

namespace App\Repository;

use App\Entity\TypeMatress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeMatress|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeMatress|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeMatress[]    findAll()
 * @method TypeMatress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeMatressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeMatress::class);
    }

    // /**
    //  * @return TypeMatress[] Returns an array of TypeMatress objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeMatress
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
