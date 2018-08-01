<?php

namespace App\Repository;

use App\Entity\Lottery;
use App\Structure\Lottery\ParticipantStructure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Lottery|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lottery|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lottery[]    findAll()
 * @method Lottery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LotteryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Lottery::class);
    }

    /**
     * @param Lottery $lottery
     * @return array|ParticipantStructure[]
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getLotteryParticipants(Lottery $lottery) :array
    {
        $conn = $this->getEntityManager()->getConnection();

        $stmt = $conn->prepare(
            "SELECT
                   ld.player_uuid as playerUUID,
                   lp.userName,
                   SUM(ld.amount) as sumAmount,
                   ROUND(SUM(ld.amount) / ltp.coefficient, 0) as ticketCount 
                FROM lottery_deposit ld
                INNER JOIN lottery_ticket_price ltp ON ltp.lottery_id = :lottery_id
                  AND ltp.currency = ld.currency
                INNER JOIN lottery_profile lp ON lp.id = ld.player_uuid
                WHERE ld.processed_at BETWEEN :date_start AND :date_end
                GROUP BY ld.player_uuid
                HAVING(ticketCount >= :entry_price)
                ORDER BY ticketCount DESC
            ;"
        );
        $stmt->execute([
            'lottery_id' => $lottery->getId(),
            'date_start' => $lottery->getStartDate()->format('Y-m-d H:i:s'),
            'date_end' => $lottery->getEndDate()->format('Y-m-d H:i:s'),
            'entry_price' => $lottery->getEntryPrice(),
        ]);

        $result = [];
        $i = 0;
        while ($row = $stmt->fetch()) {
            $participant = new ParticipantStructure();
            $participant->rank = ++$i;
            $participant->playerUUID = $row['playerUUID'];
            $participant->userName = $row['userName'];
            $participant->sumAmount = $row['sumAmount'];
            $participant->ticketCount = $row['ticketCount'];

            $result[] = $participant;
        }

        if (empty($result)) {
            return [];
        }

        $res = [
            'content' => $result,
            'length' => count($result),
        ];

        return $res;
    }

//    /**
//     * @return Lottery[] Returns an array of Lottery objects
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
    public function findOneBySomeField($value): ?Lottery
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
