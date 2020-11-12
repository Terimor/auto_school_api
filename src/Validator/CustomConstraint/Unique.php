<?php


namespace App\Validator\CustomConstraint;

use App\Validator\CustomConstraint\Validator\UniqueConstraintValidator;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Unique extends Constraint
{
    public string $message;

    public function validatedBy()
    {
        return UniqueConstraintValidator::class;
    }
}