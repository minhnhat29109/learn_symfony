<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Form\RegisterType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TestApiController extends AbstractApiController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param UserRepository $userRepository
     */
    public function __construct(
        EntityManagerInterface $em,
        UserPasswordEncoderInterface $passwordEncoder,
        UserRepository $userRepository
    ) {
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
        $users = $this->userRepository->findAll();

        return $this->Respond($users, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function store(
        Request $request
    ): Response {

        $form = $this->buildForm(RegisterType::class);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            throw new BadRequestHttpException('alo alo');
        }

        /**@var User $user */
        $user = $form->getData();
        $user->setPassword($this->passwordEncoder->encodePassword($user, $request->get('password')));
        $user->setRoles(['ROLE_USER']);
        $user->setFirstName('Nhat');
        $this->em->persist($user);
        $this->em->flush();

        return $this->Respond($user);
    }

    /**
     * @param User $user
     *
     * @return Response
     */
    public function show(User $user): Response
    {
        return $this->Respond($user, Response::HTTP_OK);
    }

    /**
     * @param User $user
     * @param Request $request
     *
     * @return Response
     */
    public function update(
        User $user,
        Request $request
    ): Response {
        $form = $this->buildForm(RegisterType::class, $user, [
            'method' => $request->getMethod(),
        ]);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->Respond($form, Response::HTTP_BAD_REQUEST);
        }

        $user = $form->getData();
        $user->setPassword($this->passwordEncoder->encodePassword($user, $request->get('password')));
        $user->setRoles(['ROLE_USER']);
        $user->setFirstName('Nhat');
        $this->em->persist($user);
        $this->em->flush();

        return $this->Respond($user);
    }

    /**
     * @param User $user
     *
     * @return Response
     */
    public function delete(User $user)
    {
        $this->em->remove($user);
        $this->em->flush();

        return $this->Respond($user);
    }
}
