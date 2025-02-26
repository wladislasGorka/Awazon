<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevelRepository::class)]
class Level
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    /**
     * @var Collection<int, LoyaltyCard>
     */
    #[ORM\OneToMany(targetEntity: LoyaltyCard::class, mappedBy: 'Levelid')]
    private Collection $loyaltyCards;

    public function __construct()
    {
        $this->loyaltyCards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, LoyaltyCard>
     */
    public function getLoyaltyCards(): Collection
    {
        return $this->loyaltyCards;
    }

    public function addLoyaltyCard(LoyaltyCard $loyaltyCard): static
    {
        if (!$this->loyaltyCards->contains($loyaltyCard)) {
            $this->loyaltyCards->add($loyaltyCard);
            $loyaltyCard->setLevelid($this);
        }

        return $this;
    }

    public function removeLoyaltyCard(LoyaltyCard $loyaltyCard): static
    {
        if ($this->loyaltyCards->removeElement($loyaltyCard)) {
            // set the owning side to null (unless already changed)
            if ($loyaltyCard->getLevelid() === $this) {
                $loyaltyCard->setLevelid(null);
            }
        }

        return $this;
    }
}
