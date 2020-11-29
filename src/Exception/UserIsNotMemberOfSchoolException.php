<?php


namespace App\Exception;


use App\Service\Exception\CriticalException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UserIsNotMemberOfSchoolException extends CriticalException
{
    private const ERROR_DESCRIPTION = 'User is not a member of school';

    public function __construct()
    {
        parent::__construct(self::ERROR_DESCRIPTION, Response::HTTP_FORBIDDEN);
    }
}