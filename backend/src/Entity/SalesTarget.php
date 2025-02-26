<?php

namespace App\Entity;

use App\Config\TypeOptionSales;
use App\Repository\SalesTargetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalesTargetRepository::class)]
class SalesTarget
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: TypeOptionSales::class)]
    private ?TypeOptionSales $type = null;

    #[ORM\ManyToOne(inversedBy: 'SalesTarget')]
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
