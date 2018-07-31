<?php

namespace App\Repository;

use App\Entity\LotteryDeposit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LotteryDeposit|null find($id, $lockMode = null, $lockVersion = null)
 * @method LotteryDeposit|null findOneBy(array $criteria, array $orderBy = null)
 * @method LotteryDeposit[]    findAll()
 * @method LotteryDeposit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LotteryDepositRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LotteryDeposit::class);
    }

//    /**
//     * @return LotteryDeposit[] Returns an array of LotteryDeposit objects
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
    public function findOneBySomeField($value): ?LotteryDeposit
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
