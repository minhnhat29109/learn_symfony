<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SiteUpdateManager
{
    /**
     * @var MessageGenerator
     */
    private $messageGenerator;
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var string
     */
    private $adminMail;

    /**
     * @param MessageGenerator $messageGenerator
     * @param MailerInterface $mailer
     * @param string $adminMail
     */
    public function __construct(MessageGenerator $messageGenerator, MailerInterface $mailer, string $adminMail)
    {
        $this->messageGenerator = $messageGenerator;
        $this->mailer = $mailer;
        $this->adminMail = $adminMail;
    }


    /**
     * @return bool
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function notifyOfSiteUpdate() : bool
    {
        $happyMessage =$this->messageGenerator->getHappyMessage();
        $email = (new Email())
            ->from('damminhnhat291098@gmail.com')
            ->to($this->adminMail)
            ->subject('test')
            ->text($happyMessage);
        $this->mailer->send($email);

        return true;
    }
}