<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImagePostController extends AbstractController
{
    /**
     * @Route("/image/post", name="image_post")
     */
    public function index(): Response
    {
        return $this->render('image_post/index.html.twig', [
            'controller_name' => 'ImagePostController',
        ]);
    }
}
