<?php


namespace App\Exception;


use Throwable;

class WrongCredentialsException extends \Exception
{
    private const ERROR_DESCRIPTION = 'Wrong credentials';

    public function __construct()
    {
        parent::__construct(self::ERROR_DESCRIPTION);
    }
}