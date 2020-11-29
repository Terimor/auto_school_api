<?php


namespace App\Validator;


use App\Core\Entity\Collection\ValidationErrorCollection;
use App\Core\Entity\ValidationError;
use App\Entity\User;
use App\Exception\ValidationErrorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserValidatorService
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(User $user): void
    {
        $errorMessages = $this->validator->validate($user);
        $validationErrorCollection = new ValidationErrorCollection();

        foreach ($errorMessages as $errorMessage) {
            $validationError = $this->buildValidationError($errorMessage);
            $validationErrorCollection->add($validationError);
        }

        if ($validationErrorCollection->count() > 0) {
            throw new ValidationErrorException($validationErrorCollection);
        }
    }

    private function buildValidationError($errorMessage): ValidationError
    {
        $validationError = new ValidationError(1, 1);

        return $validationError;
    }
}