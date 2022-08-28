<?php

namespace App\Controller\Api;

use App\Controller\BaseController;
use App\Entity\Supplier;
use App\Form\SupplierType;
use App\Service\SupplierService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupplierController extends BaseController
{
    public function __construct(private readonly SupplierService $supplierService)
    {
    }

    /**
     * @Route("/api/supplier", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function getSuppliers(Request $request): Response
    {
        $typeName = $request->query->get('typeName');

        return $this->handleView($this->view($this->supplierService->getSuppliers($typeName), Response::HTTP_OK));
    }

    /**
     * @Route("/api/supplier", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function addSupplier(Request $request): Response
    {
        $supplier = new Supplier();

        $form = $this->createForm(SupplierType::class, $supplier, [
            'method' => $request->getMethod()]);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->supplierService->addSupplier($supplier);

            return $this->handleView($this->view(null, Response::HTTP_OK));
        }

        return $this->handleView($this->view($form, Response::HTTP_BAD_REQUEST));
    }

    /**
     * @Route("/api/supplier/{id}", methods={"PATCH"})
     * @param Supplier $supplier
     * @param Request $request
     * @return Response
     */
    public function updateSupplier(Request $request, Supplier $supplier): Response
    {
        $form = $this->createForm(SupplierType::class, $supplier, [
            'method' => $request->getMethod()]);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->supplierService->updateSupplier($supplier);

            return $this->handleView($this->view(null, Response::HTTP_OK));
        }

        return $this->handleView($this->view($form, Response::HTTP_BAD_REQUEST));
    }

    /**
     * @Route("/api/supplier/{id}", methods={"DELETE"})
     * @param Supplier $supplier
     * @return Response
     */
    public function deleteSupplier(Supplier $supplier): Response
    {
        $this->supplierService->removeSupplier($supplier);

        return $this->handleView($this->view(null, Response::HTTP_OK));
    }
}