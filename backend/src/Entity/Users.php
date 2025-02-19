<?php

namespace App\Entity;

use App\Config\UsersRole;
use App\Config\UsersStatus;
use App\Repository\UsersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    private ?string $password = null;

    #[ORM\Column]
    private ?int $phone = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $register_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $login_date = null;

    #[ORM\Column]
    private ?bool $email_verif = null;

    #[ORM\Column(enumType: UsersStatus::class)]
    private ?UsersStatus $status = null;

    #[ORM\Column(enumType: UsersRole::class)]
    private ?UsersRole $role = null;

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

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

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

    public function getRegisterDate(): ?\DateTimeInterface
    {
        return $this->register_date;
    }

    public function setRegisterDate(\DateTimeInterface $register_date): static
    {
        $this->register_date = $register_date;

        return $this;
    }

    public function getLoginDate(): ?\DateTimeInterface
    {
        return $this->login_date;
    }

    public function setLoginDate(\DateTimeInterface $login_date): static
    {
        $this->login_date = $login_date;

        return $this;
    }

    public function isEmailVerif(): ?bool
    {
        return $this->email_verif;
    }

    public function setEmailVerif(bool $email_verif): static
    {
        $this->email_verif = $email_verif;

        return $this;
    }

    public function getStatus(): ?UsersStatus
    {
        return $this->status;
    }

    public function setStatus(UsersStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getRole(): ?UsersRole
    {
        return $this->role;
    }

    public function setRole(UsersRole $role): static
    {
        $this->role = $role;

        return $this;
    }
}
