<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use DoctrineExtensions\Query\Mysql;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post::class);
    }

//    /**
//     * @return Post[] Returns an array of Post objects
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
    public function findOneBySomeField($value): ?Post
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
     * 
     */
    public function findPostMonth() : ?Array
    {
        $dates = $this->createQueryBuilder('p')
            ->select('p.createdAt')
            ->getQuery()
            ->getResult()
        ;

        sort($dates);

        $months = [];

        foreach ($dates as $date) {
            $postDate = date_format($date['createdAt'], 'm Y');

            if(!\in_array($postDate, $months)) {
                $months[] = $postDate;
            }
        }

        return array_reverse($months);
    }


    public function findByDate($year, $month) :?Array
    {
        return $this->createQueryBuilder('p')
            ->where('YEAR(p.createdAt) = :year')
            ->andWhere('MONTH(p.createdAt) = :month')
            ->orderBy('p.createdAt', 'DESC')
            ->setParameters(array(
                'year' => $year,
                'month' => $month
            ))
            ->getQuery()
            ->getResult()
        ;
    }
}
