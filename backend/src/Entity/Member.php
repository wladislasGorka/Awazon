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

    #[ORM\OneToOne(mappedBy: 'member', cascade: ['persist', 'remove'])]
    private ?LoyaltyCard $loyaltyCard = null;

    /**
     * @var Collection<int, Attendance>
     */
    #[ORM\OneToMany(targetEntity: Attendance::class, mappedBy: 'member', orphanRemoval: true)]
    private Collection $attendances;

    /**
     * @var Collection<int, Shop>
     */
    #[ORM\ManyToMany(targetEntity: Shop::class, inversedBy: 'favoredBy')]
    private Collection $favoriteShops;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'favoredBy')]
    private Collection $favoriteProducts;

    /**
     * @var Collection<int, ReviewShop>
     */
    #[ORM\OneToMany(targetEntity: ReviewShop::class, mappedBy: 'member')]
    private Collection $shopReviews;

    /**
     * @var Collection<int, ReviewProduct>
     */
    #[ORM\OneToMany(targetEntity: ReviewProduct::class, mappedBy: 'member')]
    private Collection $productReviews;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'mentoring')]
    private ?self $mentor = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'mentor')]
    private Collection $mentoring;

    #[ORM\ManyToOne(inversedBy: 'members')]
    private ?City $city = null;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->carts = new ArrayCollection();
        $this->attendances = new ArrayCollection();
        $this->favoriteShops = new ArrayCollection();
        $this->favoriteProducts = new ArrayCollection();
        $this->shopReviews = new ArrayCollection();
        $this->productReviews = new ArrayCollection();
        $this->mentoring = new ArrayCollection();
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

    public function getLoyaltyCard(): ?LoyaltyCard
    {
        return $this->loyaltyCard;
    }

    public function setLoyaltyCard(LoyaltyCard $loyaltyCard): static
    {
        // set the owning side of the relation if necessary
        if ($loyaltyCard->getMember() !== $this) {
            $loyaltyCard->setMember($this);
        }

        $this->loyaltyCard = $loyaltyCard;

        return $this;
    }

    /**
     * @return Collection<int, Attendance>
     */
    public function getAttendances(): Collection
    {
        return $this->attendances;
    }

    public function addAttendance(Attendance $attendance): static
    {
        if (!$this->attendances->contains($attendance)) {
            $this->attendances->add($attendance);
            $attendance->setMember($this);
        }

        return $this;
    }

    public function removeAttendance(Attendance $attendance): static
    {
        if ($this->attendances->removeElement($attendance)) {
            // set the owning side to null (unless already changed)
            if ($attendance->getMember() === $this) {
                $attendance->setMember(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Shop>
     */
    public function getFavoriteShops(): Collection
    {
        return $this->favoriteShops;
    }

    public function addFavoriteShop(Shop $favoriteShop): static
    {
        if (!$this->favoriteShops->contains($favoriteShop)) {
            $this->favoriteShops->add($favoriteShop);
        }

        return $this;
    }

    public function removeFavoriteShop(Shop $favoriteShop): static
    {
        $this->favoriteShops->removeElement($favoriteShop);

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getFavoriteProducts(): Collection
    {
        return $this->favoriteProducts;
    }

    public function addFavoriteProduct(Product $favoriteProduct): static
    {
        if (!$this->favoriteProducts->contains($favoriteProduct)) {
            $this->favoriteProducts->add($favoriteProduct);
        }

        return $this;
    }

    public function removeFavoriteProduct(Product $favoriteProduct): static
    {
        $this->favoriteProducts->removeElement($favoriteProduct);

        return $this;
    }

    /**
     * @return Collection<int, ReviewShop>
     */
    public function getShopReviews(): Collection
    {
        return $this->shopReviews;
    }

    public function addShopReview(ReviewShop $shopReview): static
    {
        if (!$this->shopReviews->contains($shopReview)) {
            $this->shopReviews->add($shopReview);
            $shopReview->setMember($this);
        }

        return $this;
    }

    public function removeShopReview(ReviewShop $shopReview): static
    {
        if ($this->shopReviews->removeElement($shopReview)) {
            // set the owning side to null (unless already changed)
            if ($shopReview->getMember() === $this) {
                $shopReview->setMember(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ReviewProduct>
     */
    public function getProductReviews(): Collection
    {
        return $this->productReviews;
    }

    public function addProductReview(ReviewProduct $productReview): static
    {
        if (!$this->productReviews->contains($productReview)) {
            $this->productReviews->add($productReview);
            $productReview->setMember($this);
        }

        return $this;
    }

    public function removeProductReview(ReviewProduct $productReview): static
    {
        if ($this->productReviews->removeElement($productReview)) {
            // set the owning side to null (unless already changed)
            if ($productReview->getMember() === $this) {
                $productReview->setMember(null);
            }
        }

        return $this;
    }

    public function getMentor(): ?self
    {
        return $this->mentor;
    }

    public function setMentor(?self $mentor): static
    {
        $this->mentor = $mentor;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getMentoring(): Collection
    {
        return $this->mentoring;
    }

    public function addMentoring(self $mentoring): static
    {
        if (!$this->mentoring->contains($mentoring)) {
            $this->mentoring->add($mentoring);
            $mentoring->setMentor($this);
        }

        return $this;
    }

    public function removeMentoring(self $mentoring): static
    {
        if ($this->mentoring->removeElement($mentoring)) {
            // set the owning side to null (unless already changed)
            if ($mentoring->getMentor() === $this) {
                $mentoring->setMentor(null);
            }
        }

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
