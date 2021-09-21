<?php

namespace App\Controller;

use App\Service\SiteUpdateManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SendMailController extends AbstractController
{
    /**
     * @Route("/sendmail", name="send_mail")
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function index(SiteUpdateManager $siteUpdateManager)
    {
        $siteUpdateManager->notifyOfSiteUpdate();

        return new Response('ok');
    }
}
