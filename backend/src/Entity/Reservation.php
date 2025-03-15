<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\DataFixtures\ProductFixtures;
use App\DataFixtures\ShopFixtures;
use App\Config\ReservationStatus;
use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[ApiResource]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $mail = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $time = null;

    #[ORM\Column]
    private ?int $seats = null;

    #[ORM\Column(enumType: ReservationStatus::class)]
    private ?ReservationStatus $status = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Member $memberId = null;

    #[ORM\ManyToOne(targetEntity: Shop::class, inversedBy: 'reservations')]    
    #[ORM\JoinColumn(nullable: false)]
    private ?Shop $shopId = null;

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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): static
    {
        $this->time = $time;

        return $this;
    }

    public function getSeats(): ?int
    {
        return $this->seats;
    }

    public function setSeats(int $seats): static
    {
        $this->seats = $seats;

        return $this;
    }

    public function getStatus(): ?ReservationStatus
    {
        return $this->status;
    }

    public function setStatus(ReservationStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getMemberId(): ?Member
    {
        return $this->memberId;
    }

    public function setMemberId(?Member $memberId): static
    {
        $this->memberId = $memberId;

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
