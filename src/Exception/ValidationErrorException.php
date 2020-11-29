<?php


namespace App\Exception;


use App\Core\Entity\Collection\ValidationErrorCollection;
use App\Service\Exception\CriticalException;
use Symfony\Component\HttpFoundation\Response;

class ValidationErrorException extends CriticalException
{
    private const ERROR_DESCRIPTION = 'Some fields could\'t be validated';

    private ValidationErrorCollection $errorCollection;

    public function __construct(ValidationErrorCollection $errorCollection)
    {
        $this->errorCollection = $errorCollection;
        parent::__construct(self::ERROR_DESCRIPTION, Response::HTTP_BAD_REQUEST);
    }

    public function getErrorCollection(): ValidationErrorCollection
    {
        return $this->errorCollection;
    }
}