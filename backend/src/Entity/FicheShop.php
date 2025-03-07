<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Config\FicheShopStatus;
use App\Repository\FicheShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FicheShopRepository::class)]
#[ApiResource]
class FicheShop
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = '';

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = '';

    #[ORM\Column(enumType: FicheShopStatus::class)]
    private ?FicheShopStatus $status = FicheShopStatus::Pending;

    /**
     * @var Collection<int, InfoFicheShop>
     */
    #[ORM\OneToMany(targetEntity: InfoFicheShop::class, mappedBy: 'ficheShop', orphanRemoval: true)]
    private Collection $infosFicheShop;

    #[ORM\OneToOne(mappedBy: 'ficheShop', cascade: ['persist', 'remove'])]
    private ?Shop $shop = null;

    public function __construct()
    {
        $this->infosFicheShop = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?FicheShopStatus
    {
        return $this->status;
    }

    public function setStatus(FicheShopStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, InfoFicheShop>
     */
    public function getInfosFicheShop(): Collection
    {
        return $this->infosFicheShop;
    }

    public function addInfosFicheShop(InfoFicheShop $infosFicheShop): static
    {
        if (!$this->infosFicheShop->contains($infosFicheShop)) {
            $this->infosFicheShop->add($infosFicheShop);
            $infosFicheShop->setFicheShop($this);
        }

        return $this;
    }

    public function removeInfosFicheShop(InfoFicheShop $infosFicheShop): static
    {
        if ($this->infosFicheShop->removeElement($infosFicheShop)) {
            // set the owning side to null (unless already changed)
            if ($infosFicheShop->getFicheShop() === $this) {
                $infosFicheShop->setFicheShop(null);
            }
        }

        return $this;
    }

    public function getShop(): ?Shop
    {
        return $this->shop;
    }

    public function setShop(?Shop $shop): static
    {
        // unset the owning side of the relation if necessary
        if ($shop === null && $this->shop !== null) {
            $this->shop->setFicheShop(null);
        }

        // set the owning side of the relation if necessary
        if ($shop !== null && $shop->getFicheShop() !== $this) {
            $shop->setFicheShop($this);
        }

        $this->shop = $shop;

        return $this;
    }
}
