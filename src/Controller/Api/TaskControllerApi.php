<?php

namespace App\Controller\Api;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskControllerApi extends AbstractController
{
    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        $task = $this->getDoctrine()->getRepository(Task::class)->findAll();

        return $this->json($task);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function taskCreate(Request $request): Response
    {
        return $this->json('');
    }
}