<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Config\TypeShop;
use App\Repository\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShopRepository::class)]
#[ApiResource]
class Shop
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = '';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = '';

    #[ORM\Column]
    private ?int $siret = null;

    #[ORM\Column(length: 255)]
    private ?string $address = '';

    #[ORM\Column(nullable: true)]
    private ?float $longitude = null;

    #[ORM\Column(nullable: true)]
    private ?float $latitude = null;

    #[ORM\Column(length: 20)] // Ajustez la longueur selon vos besoins
    private ?string $phone = '';

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $open_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creation_date = null;

    #[ORM\Column(length: 50)]
    private ?string $status = '';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $paypal_account = '';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $paypal_id = '';

    #[ORM\OneToOne(inversedBy: 'shop', cascade: ['persist', 'remove'])]
    private ?FicheShop $ficheShop = null;

    /**
     * @var Collection<int, ImageShop>
     */
    #[ORM\OneToMany(targetEntity: ImageShop::class, mappedBy: 'shop', orphanRemoval: true)]
    private Collection $imagesShop;

    #[ORM\Column(enumType: TypeShop::class)]
    private ?TypeShop $type = TypeShop::MAGASIN;

    /**
     * @var Collection<int, CategoryShop>
     */
    #[ORM\ManyToMany(targetEntity: CategoryShop::class, inversedBy: 'shops')]
    private Collection $categories;

    /**
     * @var Collection<int, OrderShop>
     */
    #[ORM\OneToMany(targetEntity: OrderShop::class, mappedBy: 'shop')]
    private Collection $orders;

    /**
     * @var Collection<int, GiftCode>
     */
    #[ORM\OneToMany(targetEntity: GiftCode::class, mappedBy: 'shop')]
    private Collection $giftCodes;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'shopId')]
    private Collection $reservations;

    #[ORM\ManyToOne(targetEntity: Merchant::class, inversedBy: 'shops')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Merchant $merchantId = null;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'shop', orphanRemoval: true)]
    private Collection $products;

    /**
     * @var Collection<int, Event>
     */
    #[ORM\OneToMany(targetEntity: Event::class, mappedBy: 'shop')]
    private Collection $events;

    /**
     * @var Collection<int, Sales>
     */
    #[ORM\OneToMany(targetEntity: Sales::class, mappedBy: 'shop', orphanRemoval: true)]
    private Collection $sales;

    /**
     * @var Collection<int, Member>
     */
    #[ORM\ManyToMany(targetEntity: Member::class, mappedBy: 'favoriteShops')]
    private Collection $favoredBy;

    /**
     * @var Collection<int, ReviewShop>
     */
    #[ORM\OneToMany(targetEntity: ReviewShop::class, mappedBy: 'shop')]
    private Collection $reviews;

    #[ORM\ManyToOne(inversedBy: 'shops')]
    #[ORM\JoinColumn(nullable: false)]
    private ?City $city = null;

    public function __construct()
    {
        $this->imagesShop = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->giftCodes = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->sales = new ArrayCollection();
        $this->favoredBy = new ArrayCollection();
        $this->reviews = new ArrayCollection();
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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(int $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getOpenDate(): ?\DateTimeInterface
    {
        return $this->open_date;
    }

    public function setOpenDate(?\DateTimeInterface $open_date): static
    {
        $this->open_date = $open_date;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPaypalAccount(): ?string
    {
        return $this->paypal_account;
    }

    public function setPaypalAccount(?string $paypal_account): static
    {
        $this->paypal_account = $paypal_account;

        return $this;
    }

    public function getPaypalId(): ?string
    {
        return $this->paypal_id;
    }

    public function setPaypalId(?string $paypal_id): static
    {
        $this->paypal_id = $paypal_id;

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

    /**
     * @return Collection<int, ImageShop>
     */
    public function getImagesShop(): Collection
    {
        return $this->imagesShop;
    }

    public function addImagesShop(ImageShop $imagesShop): static
    {
        if (!$this->imagesShop->contains($imagesShop)) {
            $this->imagesShop->add($imagesShop);
            $imagesShop->setShop($this);
        }

        return $this;
    }

    public function removeImagesShop(ImageShop $imagesShop): static
    {
        if ($this->imagesShop->removeElement($imagesShop)) {
            // set the owning side to null (unless already changed)
            if ($imagesShop->getShop() === $this) {
                $imagesShop->setShop(null);
            }
        }

        return $this;
    }

    public function getType(): ?TypeShop
    {
        return $this->type;
    }

    public function setType(TypeShop $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, CategoryShop>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(CategoryShop $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(CategoryShop $category): static
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, OrderShop>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(OrderShop $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setShop($this);
        }

        return $this;
    }

    public function removeOrder(OrderShop $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getShop() === $this) {
                $order->setShop(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GiftCode>
     */
    public function getGiftCodes(): Collection
    {
        return $this->giftCodes;
    }

    public function addGiftCode(GiftCode $giftCode): static
    {
        if (!$this->giftCodes->contains($giftCode)) {
            $this->giftCodes->add($giftCode);
            $giftCode->setShopId($this);
        }

        return $this;
    }

    public function removeGiftCode(GiftCode $giftCode): static
    {
        if ($this->giftCodes->removeElement($giftCode)) {
            // set the owning side to null (unless already changed)
            if ($giftCode->getShopId() === $this) {
                $giftCode->setShopId(null);
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
            $reservation->setShopId($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getShopId() === $this) {
                $reservation->setShopId(null);
            }
        }

        return $this;
    }

    public function getMerchantId(): ?Merchant
    {
        return $this->merchantId;
    }

    public function setMerchantId(Merchant $merchantId): static
    {
        $this->merchantId = $merchantId;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setShopId($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getShopId() === $this) {
                $product->setShopId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setShop($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getShop() === $this) {
                $event->setShop(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sales>
     */
    public function getSales(): Collection
    {
        return $this->sales;
    }

    public function addSale(Sales $sale): static
    {
        if (!$this->sales->contains($sale)) {
            $this->sales->add($sale);
            $sale->setShop($this);
        }

        return $this;
    }

    public function removeSale(Sales $sale): static
    {
        if ($this->sales->removeElement($sale)) {
            // set the owning side to null (unless already changed)
            if ($sale->getShop() === $this) {
                $sale->setShop(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Member>
     */
    public function getFavoredBy(): Collection
    {
        return $this->favoredBy;
    }

    public function addFavoredBy(Member $favoredBy): static
    {
        if (!$this->favoredBy->contains($favoredBy)) {
            $this->favoredBy->add($favoredBy);
            $favoredBy->addFavoriteShop($this);
        }

        return $this;
    }

    public function removeFavoredBy(Member $favoredBy): static
    {
        if ($this->favoredBy->removeElement($favoredBy)) {
            $favoredBy->removeFavoriteShop($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ReviewShop>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(ReviewShop $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setShop($this);
        }

        return $this;
    }

    public function removeReview(ReviewShop $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getShop() === $this) {
                $review->setShop(null);
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
