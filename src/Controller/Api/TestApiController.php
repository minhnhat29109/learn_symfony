<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @var EntityRepository
     */
    public function __construct(
        EntityManagerInterface $em,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
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
    public function show(User $user)
    {
        return $this->Respond($user);
    }

    /**
     * @param User $user
     * @param Request $request
     *
     * @return Response
     */
    public function update(
        User $user,
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder
    ): Response {
//        dd($user);
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

        return $this->Respond($user, Response::HTTP_OK);
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

        return $this->Respond($user, Response::HTTP_OK);
    }
}
