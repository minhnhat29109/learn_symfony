<?php

namespace App\Controller;

use App\Message\SmsNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @param MessageBusInterface $messageBus
     */
    public function index(MessageBusInterface $messageBus)
    {
        $messageBus->dispatch(new SmsNotification('created a message'));
        $this->dispatchMessage(new SmsNotification('created a message'));
    }
}
