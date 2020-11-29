<?php


namespace App\Service\Exception;


use Throwable;

abstract class CriticalException extends \Exception
{
    private int $responseStatusCode;

    public function __construct($message, $responseStatusCode, $code = 0, Throwable $previous = null)
    {
        $this->responseStatusCode = $responseStatusCode;
        parent::__construct($message, $code, $previous);
    }

    public function getResponseStatusCode(): int
    {
        return $this->responseStatusCode;
    }
}