<?php

namespace App\Repository;

use App\Entity\TrainingOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TrainingOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrainingOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrainingOffer[]    findAll()
 * @method TrainingOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainingOfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrainingOffer::class);
    }

    // /**
    //  * @return TrainingOffer[] Returns an array of TrainingOffer objects
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
    public function findOneBySomeField($value): ?TrainingOffer
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
