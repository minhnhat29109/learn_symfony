<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class TaskController extends AbstractController
{
    /**
     * @Route("admin/new-task",name="new-task")
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
//        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        $form = $this->createForm(TaskType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /**@var Task $task */
            $task = $form->getData();
            $em->persist($task);
            $em->flush();
            $this->addFlash(
               'success',
               'add success'
            );
            return $this->redirectToRoute('list-task');

        }
        return $this->render('task/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("list-task", name="list-task")
     */
    public function show(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Task::class);
        $tasks = $repository->findAll();
        return $this->render('task/show-list-task.html.twig', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * @Route ("edit-task/{id}", name="edit-task")
     */
    public function edit(Task $task, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $task = $form->getData();
            $em->persist($task);
            $em->flush();
            $this->addFlash('success', 'Edit success');
            return $this->redirectToRoute('list-task');
        }
        return $this->render('task/edit-task.html.twig', [
            'task' => $task,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route ("delete-task/{id}", name="delete-task")
    */
    public function delete($id, EntityManagerInterface $em)
    {
        $task = $em->getRepository(Task::class)->find($id);
        $em->remove($task);
        $em->flush();
        $this->addFlash('success', 'Delete success');
        return $this->redirectToRoute('list-task');
    }
}
