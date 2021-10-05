<?php

namespace App\Controller;

use App\Message\SmsNotification;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;

class MessageController
{
    /**
     * @Route ("/message")
     * @param MessageBusInterface $bus
     * @param Request $request
     */
    public function testMessage(MessageBusInterface $bus, Request $request)
    {
        $user = [
            'alo',
            'blo'
        ];
        $bus->dispatch(new SmsNotification(
            $request->query->get('messages', 'hello'),
            $user
        ));
        return new Response('ok');
    }
}