<?php


namespace App\Controller;


use App\Builder\ResponseBuilder;
use JMS\Serializer\Serializer;


class AbstractController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    protected ResponseBuilder $responseBuilder;

    public function __construct(ResponseBuilder $responseBuilder)
    {
        $this->responseBuilder = $responseBuilder;
    }
}