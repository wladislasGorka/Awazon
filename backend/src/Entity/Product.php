<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductRepository;
use App\DataFixtures\ShopFixtures;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 50)]
    private ?string $name = '';

    #[ORM\Column(length: 255)]
    private ?string $description = '';

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 50)]
    private ?string $stock = '';

    /**
     * @var Collection<int, Keyword>
     */
    #[ORM\OneToMany(targetEntity: Keyword::class, mappedBy: 'product')]
    private Collection $Keyword;

   
    /**
     * @var Collection<int, ProductImage>
     */
    #[ORM\OneToMany(targetEntity: ProductImage::class, mappedBy: 'product')]
    private Collection $ProductImage;

    /**
     * @var Collection<int, ProductInfo>
     */
    #[ORM\OneToMany(targetEntity: ProductInfo::class, mappedBy: 'product')]
    private Collection $ProductInfo;

    /**
     * @var Collection<int, Option>
     */
    #[ORM\OneToMany(targetEntity: Option::class, mappedBy: 'product')]
    private Collection $OptionId;

    /**
     * @var Collection<int, OrderProduct>
     */
    #[ORM\OneToMany(targetEntity: OrderProduct::class, mappedBy: 'product')]
    private Collection $orders;

    /**
     * @var Collection<int, Cart>
     */
    #[ORM\OneToMany(targetEntity: Cart::class, mappedBy: 'productId', orphanRemoval: true)]
    private Collection $carts;

    #[ORM\ManyToOne(targetEntity: Shop::class, inversedBy: 'product')]    
    #[ORM\JoinColumn(nullable: false)]
    private ?Shop $shop = null;

    /**
     * @var Collection<int, Member>
     */
    #[ORM\ManyToMany(targetEntity: Member::class, mappedBy: 'favoriteProducts')]
    private Collection $favoredBy;

    /**
     * @var Collection<int, ReviewProduct>
     */
    #[ORM\OneToMany(targetEntity: ReviewProduct::class, mappedBy: 'product')]
    private Collection $reviews;

    #[ORM\ManyToOne(inversedBy: 'product')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SubCategory $subCategory = null;
    

    public function __construct()
    {
        $this->Keyword = new ArrayCollection();
        $this->ProductImage = new ArrayCollection();
        $this->ProductInfo = new ArrayCollection();
        $this->OptionId = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->carts = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getStock(): ?string
    {
        return $this->stock;
    }

    public function setStock(string $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Collection<int, Keyword>
     */
    public function getKeyword(): Collection
    {
        return $this->Keyword;
    }

    public function addKeyword(Keyword $keyword): static
    {
        if (!$this->Keyword->contains($keyword)) {
            $this->Keyword->add($keyword);
            $keyword->setProduct($this);
        }

        return $this;
    }

    public function removeKeyword(Keyword $keyword): static
    {
        if ($this->Keyword->removeElement($keyword)) {
            // set the owning side to null (unless already changed)
            if ($keyword->getProduct() === $this) {
                $keyword->setProduct(null);
            }
        }

        return $this;
    }
    public function getSubCategory(): ?SubCategory
    {
        return $this->subCategory;
    }
    
    public function setSubCategory(?SubCategory $subCategory): static
    {
        $this->subCategory = $subCategory;
    
        return $this;
    }
   
    /**
     * @return Collection<int, ProductImage>
     */
    public function getProductImage(): Collection
    {
        return $this->ProductImage;
    }

    public function addProductImage(ProductImage $productImage): static
    {
        if (!$this->ProductImage->contains($productImage)) {
            $this->ProductImage->add($productImage);
            $productImage->setProduct($this);
        }

        return $this;
    }

    public function removeProductImage(ProductImage $productImage): static
    {
        if ($this->ProductImage->removeElement($productImage)) {
            // set the owning side to null (unless already changed)
            if ($productImage->getProduct() === $this) {
                $productImage->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductInfo>
     */
    public function getProductInfo(): Collection
    {
        return $this->ProductInfo;
    }

    public function addProductInfo(ProductInfo $productInfo): static
    {
        if (!$this->ProductInfo->contains($productInfo)) {
            $this->ProductInfo->add($productInfo);
            $productInfo->setProduct($this);
        }

        return $this;
    }

    public function removeProductInfo(ProductInfo $productInfo): static
    {
        if ($this->ProductInfo->removeElement($productInfo)) {
            // set the owning side to null (unless already changed)
            if ($productInfo->getProduct() === $this) {
                $productInfo->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Option>
     */
    public function getOptionId(): Collection
    {
        return $this->OptionId;
    }

    public function addOptionId(Option $optionId): static
    {
        if (!$this->OptionId->contains($optionId)) {
            $this->OptionId->add($optionId);
            $optionId->setProduct($this);
        }

        return $this;
    }

    public function removeOptionId(Option $optionId): static
    {
        if ($this->OptionId->removeElement($optionId)) {
            // set the owning side to null (unless already changed)
            if ($optionId->getProduct() === $this) {
                $optionId->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OrderProduct>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(OrderProduct $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setProduct($this);
        }

        return $this;
    }

    public function removeOrder(OrderProduct $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getProduct() === $this) {
                $order->setProduct(null);
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
            $cart->setProduct($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): static
    {
        if ($this->carts->removeElement($cart)) {
            // set the owning side to null (unless already changed)
            if ($cart->getProduct() === $this) {
                $cart->setProduct(null);
            }
        }

        return $this;
    }

    public function getShop(): ?Shop
    {
        return $this->shop;
    }

    public function setShop(?Shop $shopId): static
    {
        $this->shop = $shopId;

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
            $favoredBy->addFavoriteProduct($this);
        }

        return $this;
    }

    public function removeFavoredBy(Member $favoredBy): static
    {
        if ($this->favoredBy->removeElement($favoredBy)) {
            $favoredBy->removeFavoriteProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ReviewProduct>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(ReviewProduct $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setProduct($this);
        }

        return $this;
    }

    public function removeReview(ReviewProduct $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getProduct() === $this) {
                $review->setProduct(null);
            }
        }

        return $this;
    }
    public function getDependencies(): array
    {
        return [
            ShopFixtures::class, 
        ];
    }

}
