<?php

namespace App\Repository;

use App\Entity\TypeBeer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeBeer>
 *
 * @method TypeBeer|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeBeer|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeBeer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeBeerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeBeer::class);
    }

    /**
     * @param TypeBeer $entity
     * @return void
     */
    public function add(TypeBeer $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param TypeBeer $entity
     * @return void
     */
    public function remove(TypeBeer $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param TypeBeer $entity
     * @return void
     */
    public function update(TypeBeer $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->createQueryBuilder('t')
            ->getQuery()
            ->getArrayResult();
    }
}