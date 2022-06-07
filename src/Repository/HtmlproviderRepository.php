<?php

namespace App\Repository;

use App\Entity\Htmlprovider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Htmlprovider>
 *
 * @method Htmlprovider|null find($id, $lockMode = null, $lockVersion = null)
 * @method Htmlprovider|null findOneBy(array $criteria, array $orderBy = null)
 * @method Htmlprovider[]    findAll()
 * @method Htmlprovider[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HtmlproviderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Htmlprovider::class);
    }

    public function add(Htmlprovider $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Htmlprovider $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Htmlprovider[] Returns an array of Htmlprovider objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Htmlprovider
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
