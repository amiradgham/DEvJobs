<?php

namespace App\Repository;

use App\Entity\CenterFormation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CenterFormation|null find($id, $lockMode = null, $lockVersion = null)
 * @method CenterFormation|null findOneBy(array $criteria, array $orderBy = null)
 * @method CenterFormation[]    findAll()
 * @method CenterFormation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CenterFormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CenterFormation::class);
    }

    // /**
    //  * @return CenterFormation[] Returns an array of CenterFormation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CenterFormation
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
