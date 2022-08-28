<?php

namespace App\Repository;

use App\Entity\Supplier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Supplier>
 *
 * @method Supplier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Supplier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Supplier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupplierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Supplier::class);
    }

    /**
     * @param Supplier $entity
     * @return void
     */
    public function add(Supplier $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Supplier $entity
     * @return void
     */
    public function remove(Supplier $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param Supplier $entity
     * @return void
     */
    public function update(Supplier $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param string|null $typeName
     * @return array
     */
    public function findSuppliers(string $typeName=null): array
    {
        $query = $this->createQueryBuilder('s');

        if($typeName) {
            $query
                ->innerJoin('s.beers', 'b')
                ->innerJoin('b.type', 't')
                ->where('t.type=:typeName')
                ->setParameter('typeName', $typeName);
        }

        return $query
            ->getQuery()
            ->getResult();
    }
}
