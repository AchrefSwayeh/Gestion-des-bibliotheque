<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }
    /**
     * @return Livre[] Returns an array of Livre objects
     */
    public function findByPrixSup($prix)
    {
        return $this->createQueryBuilder('l')

            ->setParameter('val', $prix)
            ->andWhere('l.prix > :val')
            ->orderBy('l.prix', 'DESC')
            //->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }
    public function findByPrixPages($prix,$page)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.prix > :val AND l.page < :val2')
            ->setParameter('val', $prix)
            ->setParameter('val2',$page)

            ->orderBy('l.titre', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }
    public function findByPrixPages10($prix,$page)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.prix > :val AND l.page < :val2')
            ->setParameter('val', $prix)
            ->setParameter('val2',$page)
            ->orderBy('l.prix', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }
    public function findByPrixPagesTrie($prix,$page)
    {
        return $this->createQueryBuilder('l')

            ->setParameter('val', $prix)
            ->setParameter('val2',$page)
            ->andWhere('l.prix > :val AND l.page < :val2')
            ->orderBy('l.prix', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }
    public function findByPrixPages10Trie($prix,$page)
    {
        return $this->createQueryBuilder('l')

            ->setParameter('val', $prix)
            ->setParameter('val2',$page)
            ->andWhere('l.prix > :val AND l.page < :val2')
            ->orderBy('l.prix', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

    }
    public function findByPrixPagesAuteurTrie($prix,$page)
    {
        return $this->createQueryBuilder('l')

            ->setParameter('val', $prix)
            ->setParameter('val2',$page)
            ->andWhere('l.prix > :val AND l.page < :val2')

            ->orderBy('l.prix', 'DESC')
            //->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Livre[] Returns an array of Livre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
