<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
#[ApiResource]
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
}
