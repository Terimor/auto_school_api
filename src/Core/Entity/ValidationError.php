<?php


namespace App\Core\Entity;


use JMS\Serializer\Annotation as Serializer;

class ValidationError
{
    /** @Serializer\Type("string") */
    private string $fieldName;

    /** @Serializer\Type("string") */
    private string $errorMessage;

    public function __construct(string $fieldName, string $errorMessage)
    {
        $this->fieldName = $fieldName;
        $this->errorMessage = $errorMessage;
    }

    public function getFieldName(): string
    {
        return $this->fieldName;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}