<?php

namespace App\Repository;

use App\Entity\TypeTopperMatress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeTopperMatress|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeTopperMatress|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeTopperMatress[]    findAll()
 * @method TypeTopperMatress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeTopperMatressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeTopperMatress::class);
    }

    // /**
    //  * @return TypeTopperMatress[] Returns an array of TypeTopperMatress objects
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
    public function findOneBySomeField($value): ?TypeTopperMatress
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
