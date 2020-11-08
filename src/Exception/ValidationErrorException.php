<?php


namespace App\Exception;


use Doctrine\Common\Collections\ArrayCollection;

class ValidationErrorException extends \Exception
{
    private const ERROR_DESCRIPTION = 'Some fields could\'t be validated';

    private ArrayCollection $errorCollection;

    public function __construct(ArrayCollection $errorCollection)
    {
        $this->errorCollection = $errorCollection;
        parent::__construct(self::ERROR_DESCRIPTION);
    }
}