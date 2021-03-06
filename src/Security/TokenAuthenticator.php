<?php


namespace App\Security;


use App\Constants\RoutesConst;
use App\Entity\User;
use App\Exception\UnauthorizedException;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;


class TokenAuthenticator extends AbstractGuardAuthenticator
{
    private UserPasswordEncoderInterface $passwordEncoder;
    private UserRepository $userRepository;

    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        UserRepository $userRepository
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
    }

    public function start(Request $request, AuthenticationException $authException = null): JsonResponse
    {
        throw new UnauthorizedException();
    }

    public function supports(Request $request): bool
    {
        return !in_array($request->attributes->get('_route'), [RoutesConst::NAME_LOGIN, RoutesConst::NAME_REGISTRATION]);
    }

    public function getCredentials(Request $request): string
    {
        return $request->headers->get(User::HEADER_AUTH_TOKEN_NAME, '');
    }

    public function getUser($credentials, UserProviderInterface $userProvider): UserInterface
    {
        if ($credentials === null) {
            return null;
        }

        return $userProvider->loadUserByUsername($credentials);
    }

    public function checkCredentials($credentials, UserInterface $user): bool
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        throw $exception;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        return null;
    }

    public function supportsRememberMe()
    {
        return false;
    }
}