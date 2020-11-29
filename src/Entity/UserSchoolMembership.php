<?php

namespace App\Entity;

use App\Repository\UserSchoolMembershipRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserSchoolMembershipRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class UserSchoolMembership
{
    public const ROLE_STUDENT = 'ROLE_STUDENT';
    public const ROLE_DRIVER = 'ROLE_DRIVER';
    public const ROLE_ADMINISTRATOR = 'ROLE_ADMINISTRATOR';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="memberships")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity=School::class, inversedBy="memberships")
     * @ORM\JoinColumn(nullable=false)
     */
    private School $school;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $role;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $createdAt;

    public function __construct(
        User $user,
        School $school,
        string $role
    ) {
        $this->user = $user;
        $this->school = $school;
        $this->role = $role;
    }

    /** @ORM\PrePersist() */
    private function setCreatedAt(): void
    {
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getSchool(): School
    {
        return $this->school;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }
}
