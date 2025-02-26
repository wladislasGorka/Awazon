<?php

namespace App\Entity;

use App\Repository\SalesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalesRepository::class)]
#[ORM\Table(name:'`sales`')]
class Sales
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $slogan = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 10)]
    private ?string $pourcent = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_end = null;

    /**
     * @var Collection<int, SalesImage>
     */
    #[ORM\OneToMany(targetEntity: SalesImage::class, mappedBy: 'sales')]
    private Collection $SalesImage;

    /**
     * @var Collection<int, SalesTarget>
     */
    #[ORM\OneToMany(targetEntity: SalesTarget::class, mappedBy: 'sales')]
    private Collection $SalesTarget;

    public function __construct()
    {
        $this->SalesImage = new ArrayCollection();
        $this->SalesTarget = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    public function setSlogan(string $slogan): static
    {
        $this->slogan = $slogan;

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

    public function getPourcent(): ?string
    {
        return $this->pourcent;
    }

    public function setPourcent(string $pourcent): static
    {
        $this->pourcent = $pourcent;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(\DateTimeInterface $date_start): static
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(\DateTimeInterface $date_end): static
    {
        $this->date_end = $date_end;

        return $this;
    }

    /**
     * @return Collection<int, SalesImage>
     */
    public function getSalesImage(): Collection
    {
        return $this->SalesImage;
    }

    public function addSalesImage(SalesImage $SalesImage): static
    {
        if (!$this->SalesImage->contains($SalesImage)) {
            $this->SalesImage->add($SalesImage);
            $SalesImage->setSales($this);
        }

        return $this;
    }

    public function removeSalesImage(SalesImage $salesImage): static
    {
        if ($this->SalesImage->removeElement($salesImage)) {
            // set the owning side to null (unless already changed)
            if ($salesImage->getSales() === $this) {
                $salesImage->setSales(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SalesTarget>
     */
    public function getSalesTarget(): Collection
    {
        return $this->SalesTarget;
    }

    public function addSalesTarget(SalesTarget $salesTarget): static
    {
        if (!$this->SalesTarget->contains($salesTarget)) {
            $this->SalesTarget->add($salesTarget);
            $salesTarget->setSales($this);
        }

        return $this;
    }

    public function removeSalesTarget(SalesTarget $salesTarget): static
    {
        if ($this->SalesTarget->removeElement($salesTarget)) {
            // set the owning side to null (unless already changed)
            if ($salesTarget->getSales() === $this) {
                $salesTarget->setSales(null);
            }
        }

        return $this;
    }

}