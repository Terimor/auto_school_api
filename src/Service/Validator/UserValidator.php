<?php


namespace App\Service\Validator;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class UserValidator
{
    private const ERROR_TYPE_WRONG_FORMAT = 'WRONG_FORMAT';
    private const ERROR_TYPE_WRONG_LENGTH = 'WRONG_LENGTH';
    private const ERROR_TYPE_VALUE_EXISTS = 'VALUE_ALREADY_EXISTS';

    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(User $user): void
    {
        //$validatorErrors = $this->validator->validate($user);
        //dump($validatorErrors);
    }
}