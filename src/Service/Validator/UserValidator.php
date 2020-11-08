<?php


namespace App\Service\Validator;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class UserValidator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(User $user): void
    {
        $validatorErrors = $this->validator->validate($user);
    }
}