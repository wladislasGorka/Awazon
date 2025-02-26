<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
#[ORM\Table(name: '`member`')]
class Member extends Users
{
    #[ORM\Column(length: 255)]
    private ?string $img_profil = null;

    #[ORM\Column(length: 255)]
    private ?string $paypal_account = null;

    #[ORM\Column(length: 255)]
    private ?string $paypal_id = null;

    /**
     * @var Collection<int, ReviewProduct>
     */
    #[ORM\ManyToMany(targetEntity: ReviewProduct::class, inversedBy: 'members')]
    private Collection $ReviewProduct;

    /**
     * @var Collection<int, ReviewShop>
     */
    #[ORM\ManyToMany(targetEntity: ReviewShop::class, inversedBy: 'members')]
    private Collection $ReviewShop;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'memberId')]
    private Collection $orders;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'memberId')]
    private Collection $reservations;

    /**
     * @var Collection<int, Cart>
     */
    #[ORM\OneToMany(targetEntity: Cart::class, mappedBy: 'memberId', orphanRemoval: true)]
    private Collection $carts;

    public function __construct()
    {
        $this->ReviewProduct = new ArrayCollection();
        $this->ReviewShop = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->carts = new ArrayCollection();
    }

    public function getImgProfil(): ?string
    {
        return $this->img_profil;
    }

    public function setImgProfil(string $img_profil): static
    {
        $this->img_profil = $img_profil;

        return $this;
    }

    public function getPaypalAccount(): ?string
    {
        return $this->paypal_account;
    }

    public function setPaypalAccount(string $paypal_account): static
    {
        $this->paypal_account = $paypal_account;

        return $this;
    }

    public function getPaypalId(): ?string
    {
        return $this->paypal_id;
    }

    public function setPaypalId(string $paypal_id): static
    {
        $this->paypal_id = $paypal_id;

        return $this;
    }

    /**
     * @return Collection<int, ReviewProduct>
     */
    public function getReviewProduct(): Collection
    {
        return $this->ReviewProduct;
    }

    public function addReviewProduct(ReviewProduct $reviewProduct): static
    {
        if (!$this->ReviewProduct->contains($reviewProduct)) {
            $this->ReviewProduct->add($reviewProduct);
        }

        return $this;
    }

    public function removeReviewProduct(ReviewProduct $reviewProduct): static
    {
        $this->ReviewProduct->removeElement($reviewProduct);

        return $this;
    }

    /**
     * @return Collection<int, ReviewShop>
     */
    public function getReviewShop(): Collection
    {
        return $this->ReviewShop;
    }

    public function addReviewShop(ReviewShop $reviewShop): static
    {
        if (!$this->ReviewShop->contains($reviewShop)) {
            $this->ReviewShop->add($reviewShop);
        }

        return $this;
    }

    public function removeReviewShop(ReviewShop $reviewShop): static
    {
        $this->ReviewShop->removeElement($reviewShop);

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
            $order->setMemberId($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getMemberId() === $this) {
                $order->setMemberId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setMemberId($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getMemberId() === $this) {
                $reservation->setMemberId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Cart>
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): static
    {
        if (!$this->carts->contains($cart)) {
            $this->carts->add($cart);
            $cart->setMemberId($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): static
    {
        if ($this->carts->removeElement($cart)) {
            // set the owning side to null (unless already changed)
            if ($cart->getMemberId() === $this) {
                $cart->setMemberId(null);
            }
        }

        return $this;
    }
}
