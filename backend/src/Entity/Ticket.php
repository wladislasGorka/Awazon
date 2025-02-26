<?php

namespace App\Entity;

use App\Config\TicketService;
use App\Repository\TicketRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: TicketService::class)]
    private ?TicketService $service_ticket = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $sender = null;

    #[ORM\ManyToOne(inversedBy: 'receivedTickets')]
    private ?Users $recipient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServiceTicket(): ?TicketService
    {
        return $this->service_ticket;
    }

    public function setServiceTicket(TicketService $service_ticket): static
    {
        $this->service_ticket = $service_ticket;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

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

    public function getSender(): ?Users
    {
        return $this->sender;
    }

    public function setSender(?Users $sender): static
    {
        $this->sender = $sender;

        return $this;
    }

    public function getRecipient(): ?Users
    {
        return $this->recipient;
    }

    public function setRecipient(?Users $recipient): static
    {
        $this->recipient = $recipient;

        return $this;
    }
}