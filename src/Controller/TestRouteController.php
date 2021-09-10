<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestRouteController extends AbstractController
{
    /**
     * @Route("/", name="test_route")
     */
    public function index(): Response
    {
        return $this->render('test_route/index.html.twig', [
            'controller_name' => 'Dam Minh Nhat',
        ]);
    }
}
