<?php


namespace App\EventListener;

use App\Service\Exception\CriticalException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpFoundation\Response;


class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

        if ($throwable instanceof CriticalException) {
            $statusCode = $throwable->getResponseStatusCode();
            $errorMessage = $throwable->getMessage();
        } else {
            //TODO::Log unhandled exception. will be implemented here - https://trello.com/c/XMSs1akB
            $errorMessage = $throwable->getMessage();//TODO::Should be replaced by default message to hide internal errors(after logging)
        }

        $response = new JsonResponse([
            'message' => $errorMessage,
            'isError' => false
        ], $statusCode);

        $event->setResponse($response);
    }
}