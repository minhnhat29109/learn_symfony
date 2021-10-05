<?php

namespace App\MessageHandler;

use App\Message\SmsNotification;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SmsNotificationHandler implements MessageHandlerInterface
{
    /**
     * @param SmsNotification $messgae
     */
    public function __invoke(SmsNotification $messgae)
    {
        foreach ($messgae->getUser() as $user) {
            echo ('send notification to '.$user);
        }
    }
}
