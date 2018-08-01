<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LotteryTicketPriceRepository")
 * @ORM\Table(
 *     name="lottery_ticket_price",
 *     indexes={
 *          @ORM\Index(name="IDX_ltp_currency", columns={"currency"})
 *      }
 * )
 */
class LotteryTicketPrice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lottery")
     * @ORM\JoinColumn(name="lottery_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $lottery;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $currency;

    /**
     * @ORM\Column(type="integer")
     */
    private $coefficient;

    public function getId()
    {
        return $this->id;
    }

    public function getLottery(): Lottery
    {
        return $this->lottery;
    }

    public function setLottery(Lottery $lottery): self
    {
        $this->lottery = $lottery;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCoefficient(): ?int
    {
        return $this->coefficient;
    }

    public function setCoefficient(int $coefficient): self
    {
        $this->coefficient = $coefficient;

        return $this;
    }
}
