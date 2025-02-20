<?php

namespace App\Entity;

use App\Config\OrderShopStatus;
use App\Repository\OrderShopRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderShopRepository::class)]
class OrderShop
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: OrderShopStatus::class)]
    private ?OrderShopStatus $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?OrderShopStatus
    {
        return $this->status;
    }

    public function setStatus(OrderShopStatus $status): static
    {
        $this->status = $status;

        return $this;
    }
}
