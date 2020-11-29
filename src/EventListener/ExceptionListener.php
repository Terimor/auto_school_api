<?php


namespace App\EventListener;

use App\Builder\ResponseBuilder;
use App\Core\Entity\ErrorResponse;
use App\Exception\ValidationErrorException;
use App\Service\Exception\CriticalException;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpFoundation\Response;


class ExceptionListener
{
    private ResponseBuilder $responseBuilder;

    public function __construct(ResponseBuilder $responseBuilder)
    {
        $this->responseBuilder = $responseBuilder;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();
        $errorResponse = new ErrorResponse();
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

        if ($throwable instanceof CriticalException) {
            $statusCode = $throwable->getResponseStatusCode();
            $errorResponse->setMessage($throwable->getMessage());

            if ($throwable instanceof ValidationErrorException) {
                $errorResponse->addAdditionalInfo('validation_errors', $throwable->getErrorCollection());
            }
        } else {
            //TODO::Log unhandled exception. will be implemented here - https://trello.com/c/XMSs1akB
            $errorResponse->setMessage($throwable->getMessage());//TODO::Should be replaced by default message to hide internal errors(after logging)
        }

        $response = $this->responseBuilder->buildJsonResponse($errorResponse, $statusCode);

        $event->setResponse($response);
    }
}