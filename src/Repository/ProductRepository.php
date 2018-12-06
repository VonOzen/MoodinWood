<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\ProductSearch;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * Get all products which are in stock (not sold)
     *
     * @return Product[]
     */
    public function findAllInStock(ProductSearch $search)
    {
        $query = $this->createQueryBuilder('p')
                      ->select('p', 'pics')
                      ->leftJoin('p.pictures', 'pics')
                      ->andWhere('p.inStock = true');

        if ($search->getMaxPrice()) {
            $query = $query->andWhere('p.price <= :maxprice')
                           ->orderBy('p.price', 'ASC')
                           ->setParameter('maxprice', $search->getMaxPrice());
        }

        if ($search->getProductType()) {
            $query = $query->andWhere('p.type = :type')
                           ->orderBy('p.price', 'ASC')
                           ->setParameter('type', $search->getProductType());
            /*if ($query->getQuery()->getResult()) {
                return 'Aucun produit ne correspond à vos recherches';
            }*/
            dump(empty($query->getQuery()->getResult()));
        }

        return $query->getQuery()->getResult();
    }
}
