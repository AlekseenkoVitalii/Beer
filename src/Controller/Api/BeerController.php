<?php

namespace App\Controller\Api;

use App\Controller\BaseController;
use App\Entity\Beer;
use App\Form\BeerType;
use App\Service\BeerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BeerController extends BaseController
{
    public function __construct(private readonly BeerService $beerService)
    {
    }

    /**
     * @Route("/api/beer", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function getBeers(Request $request): Response
    {
        $supplierName = $request->query->get('supplierName');
        $typeName = $request->query->get('typeName');

        return $this->handleView($this->view($this->beerService->getBeers($supplierName, $typeName), Response::HTTP_OK));
    }

    /**
     * @Route("/api/beer", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function addBeer(Request $request): Response
    {
        $beer = new Beer();
        $form = $this->createForm(BeerType::class, $beer, [
            'method' => $request->getMethod()]);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->getData()->getSupplier() as $supplier)
            {
                $beer->addSupplier($supplier);
            }
            $this->beerService->addBeer($beer);

            return $this->handleView($this->view(null, Response::HTTP_OK));
        }

        return $this->handleView($this->view($form, Response::HTTP_BAD_REQUEST));
    }

    /**
     * @Route("/api/beer/{id}", methods={"PATCH"})
     * @param Request $request
     * @param Beer $beer
     * @return Response
     */
    public function updateBeer(Request $request, Beer $beer): Response
    {
        $form = $this->createForm(BeerType::class, $beer, [
            'method' => $request->getMethod()]);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->beerService->updateBeer($beer);

            return $this->handleView($this->view(null, Response::HTTP_OK));
        }

        return $this->handleView($this->view($form, Response::HTTP_BAD_REQUEST));
    }

    /**
     * @Route("/api/beer/{id}", methods={"DELETE"})
     * @param Beer $beer
     * @return Response
     */
    public function deleteBeer(Beer $beer): Response
    {
        $this->beerService->removeBeer($beer);

        return $this->handleView($this->view(null, Response::HTTP_OK));
    }
}