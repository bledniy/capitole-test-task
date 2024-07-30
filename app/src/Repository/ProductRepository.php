<?php

namespace App\Repository;

use App\Application\Query\ProductQuery;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findProductsByQuery(ProductQuery $query): array
    {
        $qb = $this->createQueryBuilder('p');

        if ($category = $query->getCategory()) {
            $qb->andWhere('p.category = :category')
               ->setParameter('category', $category)
            ;
        }

        if ($priceLessThan = $query->getPriceLessThan()) {
            $qb->andWhere('p.price <= :priceLessThan')
               ->setParameter('priceLessThan', $priceLessThan)
            ;
        }

        return $qb->setMaxResults($query->getLimit())
                  ->getQuery()
                  ->getArrayResult()
        ;
    }
}
