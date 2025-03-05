<?php

namespace App\Entity;

use App\Config\UsersRole;
use App\Config\UsersStatus;
use App\Repository\UsersRepository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;// ajout de l'import
use Symfony\Component\Security\Core\User\UserInterface; // Ajout de l'import


#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'class', type: 'string')]
#[ORM\DiscriminatorMap(['Member' => Member::class, 'Merchant' => Merchant::class, 'Admin' => Admin::class, 'SuperAdmin' => SuperAdmin::class])]
abstract class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected ?int $id = null;

    #[ORM\Column(length: 50)]
    protected ?string $name = null;

    #[ORM\Column(length: 50)]
    protected ?string $first_name = null;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    protected ?string $email = null;

    #[ORM\Column(type: 'string', length: 255)]
    protected ?string $password = null;

    #[ORM\Column]
    protected ?int $phone = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    protected ?\DateTimeInterface $register_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    protected ?\DateTimeInterface $login_date = null;

    #[ORM\Column]
    protected ?bool $email_verif = null;

    #[ORM\Column(enumType: UsersStatus::class)]
    protected ?UsersStatus $status = null;

    #[ORM\Column(enumType: UsersRole::class)]
    protected ?UsersRole $role = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    /**
     * @var Collection<int, ForumSubject>
     */
    #[ORM\OneToMany(targetEntity: ForumSubject::class, mappedBy: 'user')]
    private Collection $forumSubjects;

    /**
     * @var Collection<int, ForumMessage>
     */
    #[ORM\OneToMany(targetEntity: ForumMessage::class, mappedBy: 'user')]
    private Collection $forumMessages;

    /**
     * @var Collection<int, Report>
     */
    #[ORM\OneToMany(targetEntity: Report::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $reports;

    /**
     * @var Collection<int, Ticket>
     */
    #[ORM\OneToMany(targetEntity: Ticket::class, mappedBy: 'sender')]
    private Collection $tickets;

    /**
     * @var Collection<int, Ticket>
     */
    #[ORM\OneToMany(targetEntity: Ticket::class, mappedBy: 'recipient')]
    private Collection $receivedTickets;

    /**
     * @var Collection<int, Newsletter>
     */
    #[ORM\OneToMany(targetEntity: Newsletter::class, mappedBy: 'user')]
    private Collection $newsletters;

    public function __construct()
    {
        $this->forumSubjects = new ArrayCollection();
        $this->forumMessages = new ArrayCollection();
        $this->reports = new ArrayCollection();
        $this->tickets = new ArrayCollection();
        $this->receivedTickets = new ArrayCollection();
        $this->newsletters = new ArrayCollection();
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

    /**
     * The public representation of the user (e.g. a username, an email address, etc.)
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    

    public function getUsername(): string
    {
        return $this->getUserIdentifier();
    }


    /**
     * @return Collection<int, ForumSubject>
     */
    public function getForumSubjects(): Collection
    {
        return $this->forumSubjects;
    }

    public function addForumSubject(ForumSubject $forumSubject): static
    {
        if (!$this->forumSubjects->contains($forumSubject)) {
            $this->forumSubjects->add($forumSubject);
            $forumSubject->setUser($this);
        }

        return $this;
    }

    public function removeForumSubject(ForumSubject $forumSubject): static
    {
        if ($this->forumSubjects->removeElement($forumSubject)) {
            // set the owning side to null (unless already changed)
            if ($forumSubject->getUser() === $this) {
                $forumSubject->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ForumMessage>
     */
    public function getForumMessages(): Collection
    {
        return $this->forumMessages;
    }

    public function addForumMessage(ForumMessage $forumMessage): static
    {
        if (!$this->forumMessages->contains($forumMessage)) {
            $this->forumMessages->add($forumMessage);
            $forumMessage->setUser($this);
        }

        return $this;
    }

    public function removeForumMessage(ForumMessage $forumMessage): static
    {
        if ($this->forumMessages->removeElement($forumMessage)) {
            // set the owning side to null (unless already changed)
            if ($forumMessage->getUser() === $this) {
                $forumMessage->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Report>
     */
    public function getReports(): Collection
    {
        return $this->reports;
    }

    public function addReport(Report $report): static
    {
        if (!$this->reports->contains($report)) {
            $this->reports->add($report);
            $report->setUser($this);
        }

        return $this;
    }

    public function removeReport(Report $report): static
    {
        if ($this->reports->removeElement($report)) {
            // set the owning side to null (unless already changed)
            if ($report->getUser() === $this) {
                $report->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): static
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets->add($ticket);
            $ticket->setSender($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): static
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getSender() === $this) {
                $ticket->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getReceivedTickets(): Collection
    {
        return $this->receivedTickets;
    }

    public function addReceivedTicket(Ticket $receivedTicket): static
    {
        if (!$this->receivedTickets->contains($receivedTicket)) {
            $this->receivedTickets->add($receivedTicket);
            $receivedTicket->setRecipient($this);
        }

        return $this;
    }

    public function removeReceivedTicket(Ticket $receivedTicket): static
    {
        if ($this->receivedTickets->removeElement($receivedTicket)) {
            // set the owning side to null (unless already changed)
            if ($receivedTicket->getRecipient() === $this) {
                $receivedTicket->setRecipient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Newsletter>
     */
    public function getNewsletters(): Collection
    {
        return $this->newsletters;
    }

    public function addNewsletter(Newsletter $newsletter): static
    {
        if (!$this->newsletters->contains($newsletter)) {
            $this->newsletters->add($newsletter);
            $newsletter->setUser($this);
        }

        return $this;
    }

    public function removeNewsletter(Newsletter $newsletter): static
    {
        if ($this->newsletters->removeElement($newsletter)) {
            // set the owning side to null (unless already changed)
            if ($newsletter->getUser() === $this) {
                $newsletter->setUser(null);
            }
        }

        return $this;
    }
    
}
