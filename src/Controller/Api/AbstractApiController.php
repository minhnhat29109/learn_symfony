<?php

namespace App\Controller\Api;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractApiController extends AbstractFOSRestController
{
    /**
     * @param string $type
     * @param null $data
     * @param array $option
     * @return FormInterface
     */
    protected function buildForm (string $type, $data = null, array $option = []): FormInterface
    {
        $option = array_merge($option, [
            'csrf_protection' => false
        ]);

        return $this->get('form.factory')->createNamed('', $type, $data, $option);
    }

    /**
     * @param $data
     * @param int $codeStatus
     * @return Response
     */
    public function Respond($data, int $codeStatus = Response::HTTP_OK): Response
    {
        return $this->handleView($this->view($data, $codeStatus));
    }
}