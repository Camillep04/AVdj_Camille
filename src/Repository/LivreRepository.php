<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Livre>
 *
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

//    /**
//     * @return Livre[] Returns an array of Livre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    public function findNbLivreBase($livreBase): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT COUNT (*) FROM `livre` 
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['livreBase' => $livreBase]);
        // retourne un tableau de tableaux (i.e. un ensemble de données brutes)
        return $stmt->fetchAll();
    }
    public function findLivreLettre($livreLettre): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT * FROM `livre` WHERE `titre` like "L%"
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['livreLettre' => $livreLettre]);
        // retourne un tableau de tableaux (i.e. un ensemble de données brutes)
        return $stmt->fetchAll();
    }

    public function findAuteur($auteur): array
        {
            $conn = $this->getEntityManager()->getConnection();
            $sql = '
            SELECT auteur.nom, auteur.prenom FROM `auteur` INNER JOIN `livre` ON auteur.id = livre.auteur_id > 2
            ';
            $stmt = $conn->prepare($sql);
            $stmt->execute(['auteur' => $auteur]);
            // retourne un tableau de tableaux (i.e. un ensemble de données brutes)
            return $stmt->fetchAll();
        }
        
//    public function findOneBySomeField($value): ?Livre
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
