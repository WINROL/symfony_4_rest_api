<?php

namespace App\Repository;

use App\Entity\LotteryProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LotteryProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method LotteryProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method LotteryProfile[]    findAll()
 * @method LotteryProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LotteryProfileRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LotteryProfile::class);
    }

//    /**
//     * @return LotteryProfile[] Returns an array of LotteryProfile objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LotteryProfile
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
