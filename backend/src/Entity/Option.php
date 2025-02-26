<?php

namespace App\Entity;

use App\Config\TypeOptionProduct;
use App\Repository\OptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OptionRepository::class)]
#[ORM\Table(name: '`option`')]
class Option
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(enumType: TypeOptionProduct::class)]
    private ?TypeOptionProduct $type = null;

    #[ORM\ManyToOne(inversedBy: 'OptionId')]
    private ?Product $product = null;

    /**
     * @var Collection<int, Value>
     */
    #[ORM\OneToMany(targetEntity: Value::class, mappedBy: 'optionId')]
    private Collection $ValueId;

    public function __construct()
    {
        $this->ValueId = new ArrayCollection();
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

    public function getType(): ?TypeOptionProduct
    {
        return $this->type;
    }

    public function setType(TypeOptionProduct $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return Collection<int, Value>
     */
    public function getValueId(): Collection
    {
        return $this->ValueId;
    }

    public function addValueId(Value $valueId): static
    {
        if (!$this->ValueId->contains($valueId)) {
            $this->ValueId->add($valueId);
            $valueId->setOptionId($this);
        }

        return $this;
    }

    public function removeValueId(Value $valueId): static
    {
        if ($this->ValueId->removeElement($valueId)) {
            // set the owning side to null (unless already changed)
            if ($valueId->getOptionId() === $this) {
                $valueId->setOptionId(null);
            }
        }

        return $this;
    }
}
