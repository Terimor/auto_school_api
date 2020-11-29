<?php


namespace App\Validator\CustomAssert;

use App\Validator\CustomAssert\Validator\UniqueConstraintValidator;
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