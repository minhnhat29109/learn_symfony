<?php

namespace App\Controller;

use App\Message\SmsNotification;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param MessageBusInterface $messageBus
     */
    public function index(MessageBusInterface $messageBus)
    {
        $users = $this->userRepository->getUsers();
        $messageBus->dispatch(new SmsNotification('created a message', $users));
    }
}
