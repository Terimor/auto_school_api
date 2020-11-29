<?php


namespace App\Core\Entity;


use JMS\Serializer\Annotation as Serializer;

class ErrorResponse
{
    /** @Serializer\Type("string") */
    private string $message;

    /** @Serializer\Type("array") */
    private array $additionalInfo = [];

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function addAdditionalInfo(string $key, $additionalInfo): void
    {
        $this->additionalInfo[$key] = $additionalInfo;
    }
}