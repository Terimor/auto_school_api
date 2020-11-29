<?php


namespace App\Builder;


use FOS\RestBundle\View\View;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;

class ResponseBuilder
{
    private const FORMAT_JSON = 'json';

    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function buildJsonResponse($entity, int $status, array $entityInclusionGroups = null): Response
    {
        $serializationContext = null;
        if (!is_null($entityInclusionGroups)) {
            $serializationContext = SerializationContext::create()->setGroups($entityInclusionGroups);
        }

        return new Response($this->serializer->serialize($entity, self::FORMAT_JSON, $serializationContext), $status);
    }

    public function buildEmptyResponse(): Response
    {
        return new Response('', Response::HTTP_NO_CONTENT);
    }
}