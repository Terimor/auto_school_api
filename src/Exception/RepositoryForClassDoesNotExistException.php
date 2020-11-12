<?php


namespace App\Exception;


use App\Service\Exception\CriticalException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class RepositoryForClassDoesNotExistException extends CriticalException
{
    private const ERROR_DESCRIPTION = 'Doctrine repository for className = %s does not exist';

    public function __construct(string $className)
    {
        parent::__construct(sprintf(self::ERROR_DESCRIPTION, $className), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}