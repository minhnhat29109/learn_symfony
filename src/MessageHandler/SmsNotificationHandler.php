<?php

namespace App\MessageHandler;

use App\Entity\User;
use App\Message\SmsNotification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SmsNotificationHandler implements MessageHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param SmsNotification $messgae
     *
     * @return void
     *
     * @throws \Exception
     */
    public function __invoke(SmsNotification $messgae)
    {
        $users =$messgae->getUser();

        if (empty($users)) {
            throw new \Exception('user not found');
        }

        foreach ($users as $user) {
            /** @var User $user */
            $user->setRoles(['ROLE_USER']);
            $this->entityManager->persist($user);
        }

        $this->entityManager->flush();
    }
}
