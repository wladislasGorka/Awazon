<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
#[ORM\Table(name: '`member`')]
class Member
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

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

    public function __construct()
    {
        $this->ReviewProduct = new ArrayCollection();
        $this->ReviewShop = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
}
