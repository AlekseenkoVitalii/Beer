<?php

namespace App\Controller\Api;

use App\Controller\BaseController;
use App\Entity\TypeBeer;
use App\Form\TypeBeerType;
use App\Service\TypeBeerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeBeerController extends BaseController
{
    public function __construct(private readonly TypeBeerService $typeBeerService)
    {
    }

    /**
     * @Route("/api/typeBeer", methods={"GET"})
     * @return Response
     */
    public function getAllTypes(): Response
    {
        return $this->handleView($this->view($this->typeBeerService->findAllType(), Response::HTTP_OK));
    }

    /**
     * @Route("/api/typeBeer", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function addType(Request $request): Response
    {
        $typeBeer = new TypeBeer();

        $form = $this->createForm(TypeBeerType::class, $typeBeer, [
            'method' => $request->getMethod()]);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->typeBeerService->addType($typeBeer);

            return $this->handleView($this->view(null, Response::HTTP_OK));
        }

        return $this->handleView($this->view($form, Response::HTTP_BAD_REQUEST));
    }

    /**
     * @Route("/api/typeBeer/{id}", methods={"PATCH"})
     * @param Request $request
     * @param TypeBeer $type
     * @return Response
     */
    public function updateType(Request $request, TypeBeer $type): Response
    {
        $form = $this->createForm(TypeBeerType::class, $type, [
            'method' => $request->getMethod()]);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->typeBeerService->updateType($type);

            return $this->handleView($this->view(null, Response::HTTP_OK));
        }

        return $this->handleView($this->view($form, Response::HTTP_BAD_REQUEST));
    }

    /**
     * @Route("/api/typeBeer/{id}", methods={"DELETE"})
     * @param TypeBeer $type
     * @return Response
     */
    public function deleteType(TypeBeer $type): Response
    {
        $this->typeBeerService->removeType($type);

        return $this->handleView($this->view(null, Response::HTTP_OK));
    }
}