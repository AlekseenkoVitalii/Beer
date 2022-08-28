<?php

namespace App\Repository;

use App\Entity\Beer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Beer>
 *
 * @method Beer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Beer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Beer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeerRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Beer::class);
    }

    /**
     * @param Beer $entity
     * @return void
     */
    public function add(Beer $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Beer $entity
     * @return void
     */
    public function remove(Beer $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Beer $entity
     * @return void
     */
    public function update(Beer $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param string|null $supplierName
     * @param string|null $typeName
     * @return array
     */
    public function findBeerBy(string $supplierName=null, string $typeName=null): array
    {
        $query = $this->createQueryBuilder('b');
        if($supplierName){
            $query
                ->innerJoin('b.supplier', 's')
                ->where('s.name=:supplierName')
                ->setParameter('supplierName', $supplierName);
        }
        if($typeName) {
            $query
                ->innerJoin('b.type', 't')
                ->andWhere('t.type=:typeName')
                ->setParameter('typeName', $typeName);
        }

        return $query
            ->getQuery()
            ->getResult();
    }
}