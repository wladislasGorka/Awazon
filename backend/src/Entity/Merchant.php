<?php

namespace App\Entity;

use App\Config\MerchantType;
use App\Config\MerchantStatus;
use App\Repository\MerchantRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: MerchantRepository::class)]
#[ApiResource]
class Merchant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $kbis = null;

    #[ORM\Column(enumType: MerchantType::class)]
    private ?MerchantType $type = null;

    #[ORM\Column(enumType: MerchantStatus::class)]
    private ?MerchantStatus $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getKbis(): ?string
    {
        return $this->kbis;
    }

    public function setKbis(string $kbis): static
    {
        $this->kbis = $kbis;

        return $this;
    }

    public function getType(): ?MerchantType
    {
        return $this->type;
    }

    public function setType(MerchantType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?MerchantStatus
    {
        return $this->status;
    }

    public function setStatus(MerchantStatus $status): static
    {
        $this->status = $status;

        return $this;
    }
}
