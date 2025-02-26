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

    #[ORM\ManyToOne(inversedBy: 'loyaltyCards')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Level $Levelid = null;

    #[ORM\OneToOne(inversedBy: 'loyaltyCard', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Member $member = null;

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

    public function getLevelid(): ?Level
    {
        return $this->Levelid;
    }

    public function setLevelid(?Level $Levelid): static
    {
        $this->Levelid = $Levelid;

        return $this;
    }

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(Member $member): static
    {
        $this->member = $member;

        return $this;
    }
}
