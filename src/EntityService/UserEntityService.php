<?php


namespace App\EntityService;


use App\Entity\User;
use App\Exception\WrongCredentialsException;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserEntityService
{
    private UserPasswordEncoderInterface $passwordEncoder;
    private UserRepository $userRepository;
    private EntityManagerInterface $em;

    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        UserRepository $userRepository,
        EntityManagerInterface $em
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    public function proceedRegistration(User $user): void
    {
        $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPlainPassword()));
        $user->setApiToken($this->generateApiToken());
        $this->em->persist($user);
        $this->em->flush();
    }

    private function generateApiToken(): string
    {
        return bin2hex(random_bytes(60));
    }

    public function proceedLogin(string $email, string $password): User
    {
        $user = $this->userRepository->findOneByEmail($email);
        if (!$user || !$this->passwordEncoder->isPasswordValid($user, $password)) {
            throw new WrongCredentialsException();
        }

        return $user;
    }

    public function proceedLogout(string $apiToken): void
    {
        $user = $this->userRepository->findOneByApiToken($apiToken);
        $user->setApiToken(null);
        $this->em->persist($user);
        $this->em->flush();
    }
}