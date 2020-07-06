<?php

namespace App\Repository;

use App\Entity\Etudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

    // /**
    //  * @return Etudiant[] Returns an array of Etudiant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Etudiant
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function deleteEtud($id){
        $req=$this->createQueryBuilder('e')
            ->delete(Etudiant::class,'e')
            ->where('e.id=?1')
            ->setParameter(1, $id)
            ->getQuery()
            ->getResult()
        ;



    }


public function lister($max,$min){
    $req=$this->createQueryBuilder('e')
        ->select()
        ->setMaxResults('?1')
        ->setFirstResult('?2')
        ->setParameter(1, $min)
        ->setParameter(2, $max)
        ->getQuery()
        ->getResult()
        ;

}





    public function updateEtudi($nom,$prenom,$email,$telephone,$adresse,$id){
        $req=$this->createQueryBuilder('e')
            ->update(Etudiant::class,'e')
            ->set('e.nom','?1')
            ->set('e.prenom','?2')
            ->set('e.email','?3')
            ->set('e.telephone','?4')
            ->set('e.adresse','?5')

            ->where('e.id=?6')
            ->setParameter(1, $nom)
            ->setParameter(2, $prenom)
            ->setParameter(3, $email)
            ->setParameter(4, $telephone)
            ->setParameter(5, $adresse)
            ->setParameter(6, $id)


            ->getQuery()
            ->getResult()
        ;



    }


}
