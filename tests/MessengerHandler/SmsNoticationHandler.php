<?php

namespace App\Tests\MessengerHandler;

use App\Message\SmsNotification;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmsNoticationHandler extends WebTestCase
{
    private $smsNotification;
    protected function setUp(): void
    {
        $this->smsNotification = \Mockery::mock(SmsNotification::class);
        parent::setUp();
    }
}