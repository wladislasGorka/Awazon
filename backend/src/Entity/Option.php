<?php

namespace App\Entity;

use App\Enum\TypeOptionProduct;
use App\Repository\OptionRepository;
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
}
