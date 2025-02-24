<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Config\OrderStatus;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ApiResource]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creation_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $pickup_date = null;

    #[ORM\Column(length: 255)]
    private ?string $address_bill = null;

    #[ORM\Column(enumType: OrderStatus::class)]
    private ?OrderStatus $status = null;

    /**
     * @var Collection<int, OrderShop>
     */
    #[ORM\OneToMany(targetEntity: OrderShop::class, mappedBy: 'orderId')]
    private Collection $shops;

    /**
     * @var Collection<int, OrderProduct>
     */
    #[ORM\OneToMany(targetEntity: OrderProduct::class, mappedBy: 'product')]
    private Collection $products;

    public function __construct()
    {
        $this->shops = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): static
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getPickupDate(): ?\DateTimeInterface
    {
        return $this->pickup_date;
    }

    public function setPickupDate(?\DateTimeInterface $pickup_date): static
    {
        $this->pickup_date = $pickup_date;

        return $this;
    }

    public function getAddressBill(): ?string
    {
        return $this->address_bill;
    }

    public function setAddressBill(string $address_bill): static
    {
        $this->address_bill = $address_bill;

        return $this;
    }

    public function getStatus(): ?OrderStatus
    {
        return $this->status;
    }

    public function setStatus(OrderStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, OrderShop>
     */
    public function getShops(): Collection
    {
        return $this->shops;
    }

    public function addShop(OrderShop $shop): static
    {
        if (!$this->shops->contains($shop)) {
            $this->shops->add($shop);
            $shop->setOrderId($this);
        }

        return $this;
    }

    public function removeShop(OrderShop $shop): static
    {
        if ($this->shops->removeElement($shop)) {
            // set the owning side to null (unless already changed)
            if ($shop->getOrderId() === $this) {
                $shop->setOrderId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OrderProduct>
     */
    public function getProduct(): Collection
    {
        return $this->products;
    }

    public function addProduct(OrderProduct $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setProduct($this);
        }

        return $this;
    }

    public function removeProduct(OrderProduct $product): static
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getProduct() === $this) {
                $product->setProduct(null);
            }
        }

        return $this;
    }
}
