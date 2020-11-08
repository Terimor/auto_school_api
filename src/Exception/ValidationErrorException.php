<?php


namespace App\Exception;


use App\Service\Exception\CriticalException;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Response;

class ValidationErrorException extends CriticalException
{
    private const ERROR_DESCRIPTION = 'Some fields could\'t be validated';

    private ArrayCollection $errorCollection;

    public function __construct(ArrayCollection $errorCollection)
    {
        $this->errorCollection = $errorCollection;
        parent::__construct(self::ERROR_DESCRIPTION, Response::HTTP_BAD_REQUEST);
    }

    public function getErrorCollection(): ArrayCollection
    {
        return $this->errorCollection;
    }
}