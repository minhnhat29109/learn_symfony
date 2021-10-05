<?php

namespace App\Message;

class SmsNotification
{
    /**
     * @var string
     */
    private $message;
    /**
     * @var array
     */
    private $user;

    public function __construct(string $message, array $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getUser(): array
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
