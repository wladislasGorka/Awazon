<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MerchantRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;



#[ORM\Entity(repositoryClass: MerchantRepository::class)]
#[ApiResource()]
class Merchant extends Users
{
    #[ORM\Column(length: 255)]
    private ?string $address = '';

    #[ORM\Column(length: 255)]
    private ?string $kbis = '';



    #[ORM\ManyToOne(inversedBy: 'merchants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?City $city = null;

    /**
* @var Collection<int, Shop>
*/
#[ORM\OneToMany(mappedBy: 'merchantId', targetEntity: Shop::class, orphanRemoval: true)]
private Collection $shops;


    public function __construct()
{
    // ...
    $this->shops = new ArrayCollection();
}
/**
* @return Collection<int, Shop>
*/
public function getShops(): Collection
{
    return $this->shops;
}

public function addShop(Shop $shop): static
{
    if (!$this->shops->contains($shop)) {
        $this->shops->add($shop);
        $shop->setMerchantId($this);
    }

    return $this;
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

    
    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): static
    {
        $this->city = $city;

        return $this;
    }
}
