<?php

namespace App\Repository;

use App\Entity\Produit;
use App\Filter\ProduitFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produit>
 *
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    public function add(Produit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Produit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Produit[] Returns an array of Produit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Produit
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findFiltre(ProduitFilter $filter)
    {
        $query = $this->createQueryBuilder("p")
        ->leftJoin("p.categorie" , "c")
        ;
        if ($filter->categorie) 
        {
            $query = $query
            ->andWhere("c.id IN(:cat)")
            ->setParameter("cat", $filter->categorie)
            ;
        }
        if ($filter->recherche) 
        {
            $query = $query
            ->andWhere("p.titre LIKE :recherche")
            ->orWhere("p.description LIKE :recherche")
            ->orWhere("p.prix LIKE :recherche")
            ->orWhere("c.name LIKE :recherche")
            ->setParameter("recherche", "%$filter->recherche%")
            ;
        }
        return $query->getQuery()->getResult();
    }

}
