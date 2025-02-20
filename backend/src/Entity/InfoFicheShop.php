<?php

namespace App\Entity;

use App\Repository\InfoFicheShopRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfoFicheShopRepository::class)]
class InfoFicheShop
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $value = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $icon = null;

    #[ORM\ManyToOne(inversedBy: 'infosFicheShop')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FicheShop $ficheShop = null;

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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getFicheShop(): ?FicheShop
    {
        return $this->ficheShop;
    }

    public function setFicheShop(?FicheShop $ficheShop): static
    {
        $this->ficheShop = $ficheShop;

        return $this;
    }
}
