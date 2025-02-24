<?php

namespace App\Entity;

use App\Repository\LoyaltyCardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoyaltyCardRepository::class)]
class LoyaltyCard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $points = null;

    #[ORM\Column]
    private ?int $cumul_point = null;

    #[ORM\Column(length: 50)]
    private ?string $level = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): static
    {
        $this->points = $points;

        return $this;
    }

    public function getCumulPoint(): ?int
    {
        return $this->cumul_point;
    }

    public function setCumulPoint(int $cumul_point): static
    {
        $this->cumul_point = $cumul_point;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): static
    {
        $this->level = $level;

        return $this;
    }
}
