<?php
namespace App\Tests;

use App\Controller\Api\TestApiController;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class TestApiControllerTest extends WebTestCase
{
    private $request;

    public function testStore()
    {
        $test = $this->getMockBuilder(TestApiController::class)
            ->onlyMethods(['store'])
            ->disableOriginalConstructor()
            ->getMock();
        dd($test);
        $request = new Request();
        $request->request->set('email', 'minhnhatqqq@gmail.com');
        $request->request->set('password', '123456');
//        dd($request);
        $query = $test->store($request);
        $this->assertEquals(200, $query->getStatusCode());

//        $data = [
//            'email' => 'aaaaa@gmsil.com',
//            'password' => '12133',
//        ];
//        $this->create('/api/user', $data);
//        $this->assertTrue(True);
//        $client = static::createClient();
//        $client->request('GET', '/api/user/{id}');
        $this->assertTrue(true);
    }
}
