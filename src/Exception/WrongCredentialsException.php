<?php


namespace App\Exception;


use App\Service\Exception\CriticalException;
use Symfony\Component\HttpFoundation\Response;

class WrongCredentialsException extends CriticalException
{
    private const ERROR_DESCRIPTION = 'Wrong credentials';

    public function __construct()
    {
        parent::__construct(self::ERROR_DESCRIPTION, Response::HTTP_UNAUTHORIZED);
    }
}