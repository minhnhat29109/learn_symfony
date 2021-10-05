<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhpUniTestController extends AbstractController
{
    /**
     * @Route("/php/uni/test", name="php_uni_test")
     */
    public function index(): Response
    {
        return $this->render('php_uni_test/index.html.twig', [
            'controller_name' => 'PhpUniTestController',
        ]);
    }
}
