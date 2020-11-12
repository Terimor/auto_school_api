<?php


namespace App\Bridge;


use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class RequestUserBridge
{
    private const EMAIL_KEY = 'email';
    private const PASSWORD_KEY = 'password';

    public function build(Request $request): User
    {
        $user = new User();

        $user->setEmail($request->get(self::EMAIL_KEY, ''));
        $user->setPlainPassword($request->get(self::PASSWORD_KEY, ''));

        return $user;
    }
}