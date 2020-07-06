<?php

namespace App\Repository;

use App\Entity\Chambre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Chambre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chambre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chambre[]    findAll()
 * @method Chambre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChambreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chambre::class);
    }

    // /**
    //  * @return Chambre[] Returns an array of Chambre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    */

    /*
    public function findOneBySomeField($value): ?Chambre
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function updateOccuped($id){
        $req=$this->createQueryBuilder('c')
            ->update(Chambre::class,'c')
            ->set('c.occuped','?1')
            ->where('c.id=?2')
            ->setParameter(1, 'true')
            ->setParameter(2, $id)
            ->getQuery()
            ->getResult()
        ;

    }
    public function updateOccuped2($id){
        $req=$this->createQueryBuilder('c')
            ->update(Chambre::class,'c')
            ->set('c.occuped2','?1')
            ->where('c.id=?2')
            ->setParameter(1, 'true')
            ->setParameter(2, $id)
            ->getQuery()
            ->getResult()
        ;

    }

    public function updateRoom($numeros,$id){
        $req=$this->createQueryBuilder('c')
            ->update(Chambre::class,'c')
            ->set('c.numero','?1')
            ->where('c.id=?2')
            ->setParameter(1, $numeros)
            ->setParameter(2, $id)
            ->getQuery()
            ->getResult()
            ;



    }




    public function modRoom($numBatiment,$type,$id){
        $req=$this->createQueryBuilder('c')
            ->update(Chambre::class,'c')
            ->set('c.numBatiment','?1')
            ->set('c.type','?2')

            ->where('c.id=?3')
            ->setParameter(1, $numBatiment)
            ->setParameter(2, $type)
            ->setParameter(3, $id)

            ->getQuery()
            ->getResult()
        ;



    }

    public function supRoom($id){
        $req=$this->createQueryBuilder('e')
            ->delete(Chambre::class,'e')
            ->where('e.id=?1')
            ->setParameter(1, $id)
            ->getQuery()
            ->getResult()
        ;



    }



    public function getFreeRoom($value)
    {
        $isN= $this->createQueryBuilder('c')
            ->andWhere('c.occuped is NULL')

            ->getQuery()
            ->getResult()
            ;
        $isNo= $this->createQueryBuilder('c')
            ->andWhere('c.occuped is NOT NULL')
            ->andWhere('c.occuped2 is  NULL')
            ->andWhere('c.type =:val')
            ->setParameter('val', $value)

            ->getQuery()
            ->getResult()
        ;
        $tab=array();
        $tab[]=$isN;
        $tab[]=$isNo;
        return $tab;

    }
}
