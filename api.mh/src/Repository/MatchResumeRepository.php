<?php

namespace App\Repository;

use App\Entity\MatchResume;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MatchResume>
 *
 * @method MatchResume|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatchResume|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatchResume[]    findAll()
 * @method MatchResume[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchResumeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatchResume::class);
    }

    public function save(MatchResume $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MatchResume $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function addMatchResume($data): void
    {
        $newMatchs = new MatchResume();
        $newMatchs->setGameMode($data['gameMode']);
        $newMatchs->setGameEndTimestamp($data['gameEndTimestamp']);
        $newMatchs->setGameLength($data['gameLength']);
        $newMatchs->setKda($data['kda']);
        $newMatchs->setChampLevel($data['champLevel']);
        $newMatchs->setChampionId($data['championId']);
        $newMatchs->setDeaths($data['deaths']);
        $newMatchs->setKills($data['kills']);
        $newMatchs->setAssists($data['assists']);
        $newMatchs->setChampionName($data['championName']);
        $newMatchs->setItem($data['championName']);
        $newMatchs->setLane($data['lane']);
        $newMatchs->setWardsPlaced($data['wardsPlaced']);
        $newMatchs->setWin($data['win']);
        $newMatchs->setPuuid($data['puuid']);

        $this->save($newMatchs, true);
    }
    //    /**
    //     * @return MatchResume[] Returns an array of MatchResume objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?MatchResume
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
