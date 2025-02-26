<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Config\TypeOptionSales;
use App\Repository\SalesTargetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalesTargetRepository::class)]
#[ApiResource()]
class SalesTarget
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: TypeOptionSales::class)]
    private ?TypeOptionSales $type = null;

    #[ORM\ManyToOne(inversedBy: 'salesTarget')]
    private ?Sales $sales = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?TypeOptionSales
    {
        return $this->type;
    }

    public function setType(TypeOptionSales $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getSales(): ?Sales
    {
        return $this->sales;
    }

    public function setSales(?Sales $sales): static
    {
        $this->sales = $sales;

        return $this;
    }
}
