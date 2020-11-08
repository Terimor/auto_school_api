<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    public const HEADER_AUTH_TOKEN_NAME = 'X-AUTH-TOKEN';

    public const FIELD_ID = 'id';
    public const FIELD_EMAIL = 'email';
    public const FIELD_PASSWORD = 'password';
    public const FIELD_API_TOKEN = 'apiToken';

    public const USER_ROLE_DEFAULT = 'ROLE_USER';
    public const USER_ROLE_DRIVER = 'ROLE_DRIVER';
    public const USER_ROLE_ADMIN = 'ADMIN';

    public const INCLUSION_GROUP_API_TOKEN = 'apiToken';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned"="true"})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $email;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Exclude()
     */
    private string $passwordHash;

    /**
     * @Serializer\Exclude()
     */
    private ?string $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Groups({"apiToken"})
     */
    private ?string $apiToken;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->passwordHash;
    }

    public function setPassword(string $passwordHash): self
    {
        $this->passwordHash = $passwordHash;

        return $this;
    }

    public function getPlainPassword(): string
    {
        return $this->password;
    }

    public function setPlainPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getApiToken(): ?string
    {
        return $this->apiToken;
    }

    public function setApiToken(?string $apiToken): void
    {
        $this->apiToken = $apiToken;
    }

    public function getSalt(): string
    {
        return '';
    }

    public function eraseCredentials(): void
    {
    }
}
