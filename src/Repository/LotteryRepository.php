<?php

namespace App\Repository;

use App\Entity\Lottery;
use App\Entity\LotteryProfile;
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


    protected function getLotteryParticipantsBase(Lottery $lottery, int $participantId = null) :array
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
                WHERE ld.processed_at BETWEEN :date_start AND :date_end AND (0 = :player_id OR lp.id = :player_id)
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
            'player_id' => null === $participantId ? 0 : $participantId
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

        return $result;
    }

    /**
     * @param Lottery $lottery
     * @return array
     */
    public function getLotteryParticipants(Lottery $lottery) :array
    {
        $result = $this->getLotteryParticipantsBase($lottery);

        if (empty($result)) {
            return [];
        }

        $res = [
            'content' => $result,
            'length' => count($result),
        ];

        return $res;
    }

    /**
     * @param Lottery $lottery
     * @param LotteryProfile $lotteryProfile
     * @return ParticipantStructure|null
     */
    public function getParticipantLotteryInfo(Lottery $lottery, LotteryProfile $lotteryProfile) :?ParticipantStructure
    {
        $result = $result = $this->getLotteryParticipantsBase($lottery, $lotteryProfile->getId());
        if (!$result) {
            return null;
        }

        return array_shift($result);
    }
}
