<?php

namespace App\Repository;

use App\Entity\StuffImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StuffImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method StuffImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method StuffImage[]    findAll()
 * @method StuffImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StuffImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StuffImage::class);
    }

    // /**
    //  * @return StuffImage[] Returns an array of StuffImage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StuffImage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
