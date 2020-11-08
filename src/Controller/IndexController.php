<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    /**
     * @Route("/api/index", name="index")
     */
    public function index(): Response
    {
        return new Response(123);
    }
}