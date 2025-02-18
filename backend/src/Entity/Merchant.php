<?php

namespace App\Entity;

use App\Repository\MerchantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MerchantRepository::class)]
class Merchant extends User
{
    #[ORM\Column]
    private ?int $siret = null;

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(int $siret): static
    {
        $this->siret = $siret;

        return $this;
    }
}
