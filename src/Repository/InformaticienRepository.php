<?php

namespace App\Repository;

use App\Entity\Informaticien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Informaticien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Informaticien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Informaticien[]    findAll()
 * @method Informaticien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformaticienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Informaticien::class);
    }

    // /**
    //  * @return Informaticien[] Returns an array of Informaticien objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Informaticien
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
