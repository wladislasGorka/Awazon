<?php

namespace App\Entity;

use App\Repository\MerchantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MerchantRepository::class)]
class Merchant extends Users
{
    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $kbis = null;

    #[ORM\OneToOne(mappedBy: 'merchantId', cascade: ['persist', 'remove'])]
    private ?Shop $shop = null;

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

    public function getShop(): ?Shop
    {
        return $this->shop;
    }

    public function setShop(Shop $shop): static
    {
        // set the owning side of the relation if necessary
        if ($shop->getMerchantId() !== $this) {
            $shop->setMerchantId($this);
        }

        $this->shop = $shop;

        return $this;
    }
}
