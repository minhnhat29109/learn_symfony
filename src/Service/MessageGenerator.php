<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class MessageGenerator
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return string
     */
    public function getHappyMessage(): string
    {
        $this->logger->info('hello symfony');
        return "test Message sevice";
    }
}
