<?php

namespace App\Message;

class NewUserWelcomeEmail
{
    /**
     * @var int
     */
    private $userId;

    /**
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}