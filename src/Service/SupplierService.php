<?php

namespace App\Service;

use App\Entity\Supplier;
use App\Repository\SupplierRepository;

class SupplierService
{
    private SupplierRepository $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * @param string|null $typeName
     * @return array
     */
    public function getSuppliers(string $typeName=null): array
    {
        return $this->supplierRepository->findSuppliers($typeName);
    }

    /**
     * @param Supplier $supplier
     * @return void
     */
    public function addSupplier(Supplier $supplier): void
    {
        $this->supplierRepository->add($supplier);
    }

    /**
     * @param Supplier $supplier
     * @return void
     */
    public function updateSupplier(Supplier $supplier): void
    {
        $this->supplierRepository->update($supplier);
    }

    /**
     * @param Supplier $suppliers
     * @return void
     */
    public function removeSupplier(Supplier $suppliers): void
    {
        $this->supplierRepository->remove($suppliers);
    }
}