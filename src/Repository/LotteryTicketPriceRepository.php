<?php

namespace App\Repository;

use App\Entity\LotteryTicketPrice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LotteryTicketPrice|null find($id, $lockMode = null, $lockVersion = null)
 * @method LotteryTicketPrice|null findOneBy(array $criteria, array $orderBy = null)
 * @method LotteryTicketPrice[]    findAll()
 * @method LotteryTicketPrice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LotteryTicketPriceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LotteryTicketPrice::class);
    }

//    /**
//     * @return LotteryTicketPrice[] Returns an array of LotteryTicketPrice objects
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
    public function findOneBySomeField($value): ?LotteryTicketPrice
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
