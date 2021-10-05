<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Service\MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Nexy\Slack\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class TaskController extends AbstractController
{
    /**
     * Currently unused: just showing a controller with a constructor!
     */
    private $isDebug;

    public function __construct(bool $isDebug)
    {
        $this->isDebug = $isDebug;
    }

    /**
     * @Route("admin/new-task",name="new-task")
     * @IsGranted("ROLE_USER")
     * @param EntityManagerInterface $em
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse|void
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
//        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        $form = $this->createForm(TaskType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Task $task */
//            dd($form->getData());
            $task = $form->getData();
            $task->setAuthor($this->getUser());
            $em->persist($task);
            $em->flush();
            $this->addFlash(
                'success',
                'add success'
            );

            return $this->json($task);
        }

//        return $this->json($task);
    }

    /**
     * @Route ("list-task", name="list-task")
     * @IsGranted ("ROLE_USER")
     * @param EntityManagerInterface $em
     * @param MarkdownHelper $markdownHelper
     *
     * @return Response
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function show(EntityManagerInterface $em, MarkdownHelper $markdownHelper)
    {
//        $message = $slack->createMessage()
//            ->from('Nhat')
//            ->withIcon(':ghost:')
//            ->setText('Ah, Kirk, my old friend...');
//        $slack->sendMessage($message);
//        dd($this->isDebug);
//        dd($cache);
        $content ='
Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
**turkey** shank eu pork belly meatball non cupim.
';
        $content = $markdownHelper->parse($content);
//        dd($content);

//        dd($markdow);
        $repository = $em->getRepository(Task::class);
        $tasks = $repository->findAll();

        return $this->render('task/show-list-task.html.twig', [
            'tasks' => $tasks,
            'content' => $content,
        ]);
    }

    /**
     * @Route ("edit-task/{id}", name="edit-task")
     * @IsGranted ("MANAGE", subject="task")
     * @param Task $task
     * @param Request $request
     * @param EntityManagerInterface $em
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function edit(Task $task, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
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
     * @param Task $id
     * @param EntityManagerInterface $em
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Task $id, EntityManagerInterface $em)
    {
//        $task = $em->getRepository(Task::class)->find($id);
        $em->remove($id);
        $em->flush();
        $this->addFlash('success', 'Delete success');

        return $this->redirectToRoute('list-task');
    }
}
