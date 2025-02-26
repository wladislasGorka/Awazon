<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Config\OrderShopStatus;
use App\Repository\OrderShopRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderShopRepository::class)]
#[ApiResource()]
class OrderShop
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: OrderShopStatus::class)]
    private ?OrderShopStatus $status = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Shop $shop = null;

    #[ORM\ManyToOne(inversedBy: 'shops')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $orderId = null;

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

    public function getShop(): ?Shop
    {
        return $this->shop;
    }

    public function setShop(?Shop $shop): static
    {
        $this->shop = $shop;

        return $this;
    }

    public function getOrderId(): ?Order
    {
        return $this->orderId;
    }

    public function setOrderId(?Order $orderId): static
    {
        $this->orderId = $orderId;

        return $this;
    }
}
