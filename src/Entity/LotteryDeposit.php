<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LotteryDepositRepository")
 * @ORM\Table(name="lottery_deposit")
 */
class LotteryDeposit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\LotteryProfile")
     * @ORM\JoinColumn(name="player_uuid", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * @var LotteryProfile
     */
    private $player;

    /**
     * @ORM\Column(type="datetime")
     */
    private $processed_at;

    /**
     * @ORM\Column(type="decimal", precision=18, scale=2)
     */
    private $amount;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $currency;

    public function getId()
    {
        return $this->id;
    }

    public function getProcessedAt(): ?\DateTimeInterface
    {
        return $this->processed_at;
    }

    public function setProcessedAt(\DateTimeInterface $processed_at): self
    {
        $this->processed_at = $processed_at;

        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount): self
    {
        $this->amount = $amount;

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

    /**
     * @return LotteryProfile
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param LotteryProfile $player
     * @return $this
     */
    public function setPlayer(LotteryProfile $player)
    {
        $this->player = $player;

        return $this;
    }
}
