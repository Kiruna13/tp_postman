<?php

namespace App\Repository;

use App\Entity\Requete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DriverManager;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Requete|null find($id, $lockMode = null, $lockVersion = null)
 * @method Requete|null findOneBy(array $criteria, array $orderBy = null)
 * @method Requete[]    findAll()
 * @method Requete[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RequeteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Requete::class);
    }

     /**
      * @return Requete[] Returns an array of Requete objects
      */
     /*
      * function qui selectionne les requetes a afficher.
      */
    public function ReturnAllQueries(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT r.method, r.url, r.id
            FROM App\entity\Requete r'
        );
            return $query->getResult();
    }
    /*
     * Fonction pour essayer de supprimer une requête. Malheureusement, elle supprime toutes les requetes de la bdd a cause du query.id dans index.html.twig
     * public function DeleteQuerry($id)
    {

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE App\entity\Requete r
              WHERE r.id = :id'
        );

        $query->setParameter('id', $id);

        return $query->getResult();

    }*/
}
