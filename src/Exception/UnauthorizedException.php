<?php


namespace App\Exception;


use App\Service\Exception\CriticalException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UnauthorizedException extends CriticalException
{
    private const ERROR_DESCRIPTION = 'Unauthorized';

    public function __construct()
    {
        parent::__construct(self::ERROR_DESCRIPTION, Response::HTTP_UNAUTHORIZED);
    }
}