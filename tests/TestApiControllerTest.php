<?php
namespace App\Tests;

use App\Controller\Api\TestApiController;
use App\Entity\User;
use App\Form\RegisterType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Internal\Hydration\ObjectHydrator;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TestApiControllerTest extends WebTestCase
{
    private $em;
    private $testApiController;
    private $form;
    private $request;
    private $response;
    private $object;
    private $userPassword;
    private $user;
    private $userRepository;

    protected function setUp(): void
    {
        $this->em = \Mockery::mock(EntityManagerInterface::class);
        $this->testApiController = \Mockery::mock(TestApiController::class);
        $this->form = \Mockery::mock(FormInterface::class);
        $this->response = \Mockery::mock(Response::class);
        $this->userPassword = \Mockery::mock(UserPasswordEncoderInterface::class);
        $this->user = \Mockery::mock(User::class);
        $this->userRepository = \Mockery::mock(UserRepository::class);
        $this->object = new TestApiController
        (
            $this->em,
            $this->userPassword,
            $this->userRepository
        );

        parent::setUp();
    }

    public function testIndex_empty_true()
    {
        $this->userRepository->shouldReceive('findAll')->andReturn([]);
        $this->testApiController->shouldReceive('Respond')
            ->andReturn([], Response::HTTP_BAD_REQUEST);
        $result = $this->testApiController->index();
        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
    }

    public function testIndex_empty_false()
    {
        $this->userRepository->shouldReceive('findAll')->andReturn([$this->user]);
        $this->testApiController->shouldReceive('Respond')
            ->andReturn([], Response::HTTP_OK);
        $result = $this->testApiController->index();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testStore_isSubmitted_true()
    {
        $this->form->shouldReceive('buildForm')->with(RegisterType::class)->andReturn($this->form);
        $this->form->shouldReceive('handleRequest')->with($this->request)->andReturn($this->form);
        $this->form->shouldReceive('isSubmitted')->andReturn(true);
        $this->testApiController
            ->shouldReceive('Respond')
            ->with($this->form, Response::HTTP_BAD_REQUEST)
            ->andReturn($this->response);
        $result = $this->testApiController->store($this->request);
        $this->assertEquals(400, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testStore_isSubmitted_false_isValid_true($request)
    {
        $this->form->shouldReceive('buildForm')->with(RegisterType::class)->andReturn($this->form);
        $this->form->shouldReceive('handleRequest')->with($request)->andReturn($this->form);
        $this->form->shouldReceive('isSubmitted')->andReturn(false);
        $this->form->shouldReceive('isValid')->andReturn(true);
        $this->testApiController
            ->shouldReceive('Respond')
            ->with($this->form, Response::HTTP_BAD_REQUEST)
            ->andReturn($this->response);
        $this->assertEquals(1, 1);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testStore_isSubmitted_false_isValid_false($request)
    {
        $this->form->shouldReceive('buildForm')->with(RegisterType::class)->andReturn($this->form);
        $this->form->shouldReceive('handleRequest')->with($request)->andReturn($this->form);
        $this->form->shouldReceive('isSubmitted')->andReturn(false);
        $this->form->shouldReceive('isValid')->andReturn(false);
        $this->form->shouldReceive('getData')->andReturn($this->user);
        $password = $this->request
            ->shouldReceive('get')
            ->with('password')
            ->andReturn('hghgfgf');
        $enCodePassword = $this->userPassword
            ->shouldReceive('encodePassword')
            ->with($this->user, $password)
            ->andReturn($this->user);
        $this->user->shouldReceive('setPassword')->with($enCodePassword)->andReturn($this->user);
        $this->user->shouldReceive('setRole')->with(['ROLE_USER'])->andReturn($this->user);
        $this->user->shouldReceive('setFirstName')->with('Nhat')->andReturn($this->user);
        $this->em->shouldReceive('persist')->with($this->user)->andReturn(true)->once();
        $this->em->shouldReceive('flush')->andReturn(true);
        $this->testApiController
            ->shouldReceive('Respond')
            ->with($this->form, Response::HTTP_BAD_REQUEST)
            ->andReturn($this->response);
        $this->assertEquals(1, 1);
    }

    public function dataProvider(): array
    {
        return [
            ['email' => 'assdsda@gmail.com', 'password' => '123654'],
        ];
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close();
    }

    public function dad ()
    {
        $exception = new \Exception();
        $message->shouldReceive('getUser')->andR([]);
        $this->throwException($exception);
//        $this->expectExceptionMessage('user not found');
    }

}
