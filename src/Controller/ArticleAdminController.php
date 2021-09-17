<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Michelf\MarkdownInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_USER")
 */
class ArticleAdminController extends AbstractController
{
    /**
     * @Route("admin/article/new", name="admin_article_new")
     */
    public function new(EntityManagerInterface $em, Request $request) {
    //    $article = new Article();
    //    $article->setTitle("Ha noi het covid");
    //    $article->setSlug("ha-noi-het-covid"."-".rand(100,999));
    //    $article->setContent("hihiihi");
    //    $article->setPublishedAt(new DateTime());
    //    $article->setAuthor("Thao")
    //             ->setHertCount(rand(11,99))
    //             ->setImageFileName('download.jpeg');
    //    $em->persist($article);
    //    $em->flush();
    

        $form = $this->createForm(ArticleFormType::class);
        $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {
        //     /** @var Article $article */
        //     $article = $form->getData();
        //     $article->setAuthor("Thao Le");
        //     $article->setSlug("thao-le1".rand(1111, 9999));
        //     $em->persist($article);
        //     $em->flush();
        //     $this->addFlash('success', 'add success!');
        //     return $this->redirectToRoute('admin_article_new');
        // }
        return $this->render('article_admin/index.html.twig', [
            'articleForm' => $form->createView(),
        ]);
    //    return new Response(sprintf(
    //         'Hiya! New Article id: '.$article->getId().' slug:'.$article->getSlug()
    //     ));
    }


    /**
     * @Route("show",name="article_show")
     */
    public function show(ArticleRepository $articleresponse, MarkdownInterface $markdown)
    {
//        dd($markdown);
//        die();
         $articles = $articleresponse->findAll();
        // dd($article);
        return $this->render('article_admin/index.html.twig', [
            'articles' => $articles
        ]);
    }


    /**
     * @Route("/update/{id}",name="article_update")
     */
    public function update(Article $article, EntityManagerInterface $em)
    {
        // $article = $em->getRepository(Article::class)->find($id);

        $article->setContent("Nhat Nhat1");
        $em->flush();
        return $this->redirectToRoute('article_show', [
            'id' => $article->getId()
        ]);
    }

    /**
     * @Route("/delete/{id}",name="article_delete")
     */
    public function delete($id, EntityManagerInterface $em)
    {
        $new = $em->getRepository(Article::class)->find($id);
        if (!$new) {
            return new Response(sprintf(
                'Delete Fail!'
            ));
        }
        $em->remove($new);
        $em->flush();
        return new Response(sprintf(
            'Delete Sucess'
        ));
    }
}
