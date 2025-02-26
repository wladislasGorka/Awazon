<?php

namespace App\Entity;

use App\Repository\GiftCodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: GiftCodeRepository::class)]
#[ApiResource]
class GiftCode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $code = null;

    #[ORM\Column]
    private ?int $discount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creation_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $expiration_date = null;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'giftCode')]
    private Collection $orders;

    #[ORM\ManyToOne(inversedBy: 'giftCodes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Shop $shopId = null;

    /**
     * @var Collection<int, GiftCodeTarget>
     */
    #[ORM\OneToMany(targetEntity: GiftCodeTarget::class, mappedBy: 'giftCode', orphanRemoval: true)]
    private Collection $targets;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->targets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): static
    {
        $this->discount = $discount;

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

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expiration_date;
    }

    public function setExpirationDate(\DateTimeInterface $expiration_date): static
    {
        $this->expiration_date = $expiration_date;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setGiftCode($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getGiftCode() === $this) {
                $order->setGiftCode(null);
            }
        }

        return $this;
    }

    public function getShopId(): ?Shop
    {
        return $this->shopId;
    }

    public function setShopId(?Shop $shopId): static
    {
        $this->shopId = $shopId;

        return $this;
    }

    /**
     * @return Collection<int, GiftCodeTarget>
     */
    public function getTargets(): Collection
    {
        return $this->targets;
    }

    public function addTarget(GiftCodeTarget $target): static
    {
        if (!$this->targets->contains($target)) {
            $this->targets->add($target);
            $target->setGiftCode($this);
        }

        return $this;
    }

    public function removeTarget(GiftCodeTarget $target): static
    {
        if ($this->targets->removeElement($target)) {
            // set the owning side to null (unless already changed)
            if ($target->getGiftCode() === $this) {
                $target->setGiftCode(null);
            }
        }

        return $this;
    }
}