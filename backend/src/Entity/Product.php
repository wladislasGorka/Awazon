<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductRepository;
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
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 50)]
    private ?string $stock = null;

    /**
     * @var Collection<int, Keyword>
     */
    #[ORM\OneToMany(targetEntity: Keyword::class, mappedBy: 'product')]
    private Collection $Keyword;

    /**
     * @var Collection<int, SubCategory>
     */
    #[ORM\OneToMany(targetEntity: SubCategory::class, mappedBy: 'product')]
    private Collection $SubCategory;

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

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Shop $shopId = null;

    public function __construct()
    {
        $this->Keyword = new ArrayCollection();
        $this->SubCategory = new ArrayCollection();
        $this->ProductImage = new ArrayCollection();
        $this->ProductInfo = new ArrayCollection();
        $this->OptionId = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->carts = new ArrayCollection();
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

    /**
     * @return Collection<int, SubCategory>
     */
    public function getSubCategory(): Collection
    {
        return $this->SubCategory;
    }

    public function addSubCategory(SubCategory $subCategory): static
    {
        if (!$this->SubCategory->contains($subCategory)) {
            $this->SubCategory->add($subCategory);
            $subCategory->setProduct($this);
        }

        return $this;
    }

    public function removeSubCategory(SubCategory $subCategory): static
    {
        if ($this->SubCategory->removeElement($subCategory)) {
            // set the owning side to null (unless already changed)
            if ($subCategory->getProduct() === $this) {
                $subCategory->setProduct(null);
            }
        }

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
            $cart->setProductId($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): static
    {
        if ($this->carts->removeElement($cart)) {
            // set the owning side to null (unless already changed)
            if ($cart->getProductId() === $this) {
                $cart->setProductId(null);
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
}
