<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TotoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TotoRepository::class)]
#[ApiResource]
class Toto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

<<<<<<< HEAD:backend/src/Entity/Product.php
    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 50)]
    private ?string $stock = null;

=======
>>>>>>> 67fecfdc2600c5892a4d0c637be6ea36a2214c1d:backend/src/Entity/Toto.php
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
<<<<<<< HEAD:backend/src/Entity/Product.php

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
}
=======
}
>>>>>>> 67fecfdc2600c5892a4d0c637be6ea36a2214c1d:backend/src/Entity/Toto.php
