<?php

namespace App\Service;

use App\Entity\Beer;
use App\Repository\BeerRepository;

class BeerService
{
    private BeerRepository $beerRepository;

    public function __construct(BeerRepository $beerRepository)
    {
        $this->beerRepository = $beerRepository;
    }

    /**
     * @param Beer $beer
     * @return void
     */
    public function addBeer(Beer $beer): void
    {
        $this->beerRepository->add($beer);
    }

    /**
     * @param $supplierName
     * @param $typeName
     * @return array
     */
    public function getBeers($supplierName=null, $typeName=null): array
    {
        return  $this->beerRepository->findBeerBy($supplierName, $typeName);
    }

    /**
     * @param Beer $beer
     * @return void
     */
    public function updateBeer(Beer $beer): void
    {
        $this->beerRepository->update($beer);
    }

    /**
     * @param Beer $beer
     * @return void
     */
    public function removeBeer(Beer $beer): void
    {
        $this->beerRepository->remove($beer);
    }
}


