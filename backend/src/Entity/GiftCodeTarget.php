<?php

namespace App\Entity;

use App\Config\GiftCodeTargetType;
use App\Repository\GiftCodeTargetRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: GiftCodeTargetRepository::class)]
#[ApiResource]
class GiftCodeTarget
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: GiftCodeTargetType::class)]
    private ?GiftCodeTargetType $type = null;

    #[ORM\Column]
    private ?int $target_id = null;

    #[ORM\ManyToOne(inversedBy: 'targets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GiftCode $giftCode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?GiftCodeTargetType
    {
        return $this->type;
    }

    public function setType(GiftCodeTargetType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getTargetId(): ?int
    {
        return $this->target_id;
    }

    public function setTargetId(int $target_id): static
    {
        $this->target_id = $target_id;

        return $this;
    }

    public function getGiftCode(): ?GiftCode
    {
        return $this->giftCode;
    }

    public function setGiftCode(?GiftCode $giftCode): static
    {
        $this->giftCode = $giftCode;

        return $this;
    }
}