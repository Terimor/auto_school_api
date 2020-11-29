<?php


namespace App\Exception;


use App\Service\Exception\CriticalException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class SchoolIdGetParameterIsMissingOrNotValidException extends CriticalException
{
    private const ERROR_DESCRIPTION = 'SchoolId get parameter [%s] is missing or not valid';

    public function __construct(string $schoolId)
    {
        parent::__construct(sprintf(self::ERROR_DESCRIPTION, $schoolId), Response::HTTP_BAD_REQUEST);
    }
}