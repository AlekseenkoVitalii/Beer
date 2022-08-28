<?php

namespace App\Service;

use App\Entity\TypeBeer;
use App\Repository\TypeBeerRepository;

class TypeBeerService
{
    private TypeBeerRepository $typeBeerRepository;

    public function __construct(TypeBeerRepository $typeBeerRepository)
    {
        $this->typeBeerRepository = $typeBeerRepository;
    }

    /**
     * @return array
     */
    public function findAllType(): array
    {
        return $this->typeBeerRepository->findAll();
    }

    /**
     * @param TypeBeer $typeBeer
     * @return void
     */
    public function addType(TypeBeer $typeBeer): void
    {
        $this->typeBeerRepository->add($typeBeer);
    }

    /**
     * @param TypeBeer $typeBeer
     * @return void
     */
    public function updateType(TypeBeer $typeBeer): void
    {
        $this->typeBeerRepository->update($typeBeer);
    }

    /**
     * @param TypeBeer $typeBeer
     * @return void
     */
    public function removeType(TypeBeer $typeBeer): void
    {
        $this->typeBeerRepository->remove($typeBeer);
    }
}