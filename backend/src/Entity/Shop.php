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
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column]
    private ?int $siret = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(nullable: true)]
    private ?float $longitude = null;

    #[ORM\Column(nullable: true)]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?int $phone = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $open_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creation_date = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $paypal_account = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $paypal_id = null;

    #[ORM\OneToOne(inversedBy: 'shop', cascade: ['persist', 'remove'])]
    private ?FicheShop $ficheShop = null;

    /**
     * @var Collection<int, ImageShop>
     */
    #[ORM\OneToMany(targetEntity: ImageShop::class, mappedBy: 'shop', orphanRemoval: true)]
    private Collection $imagesShop;

    #[ORM\Column(enumType: TypeShop::class)]
    private ?TypeShop $type = null;

    /**
     * @var Collection<int, CategoryShop>
     */
    #[ORM\ManyToMany(targetEntity: CategoryShop::class, inversedBy: 'shops')]
    private Collection $categories;

    public function __construct()
    {
        $this->imagesShop = new ArrayCollection();
        $this->categories = new ArrayCollection();
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

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): static
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
}
