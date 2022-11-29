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
    public function addMatchResume($data, $items, $puuid): void
    {
        $newMatchs = new MatchResume();
        $newMatchs->setGameMode($data['info']['gameMode']);
        $newMatchs->setGameLenght($data['info']['gameDuration']);
        $newMatchs->setChampLevel($data['info']['participants']['champLevel']);
        $newMatchs->setChampionId($data['info']['participants']['championId']);
        $newMatchs->setDeaths($data['info']['participants']['deaths']);
        $newMatchs->setKills($data['info']['participants']['kills']);
        $newMatchs->setAssists($data['info']['participants']['assists']);
        $newMatchs->setChampionName($data['info']['participants']['championName']);
        $newMatchs->setItem($items);
        $newMatchs->setSum1($data['info']['participants']['summoner1Id']);
        $newMatchs->setSum2($data['info']['participants']['summoner2Id']);
        $newMatchs->setPerk1($data['info']['participants']['perks']['styles'][0]['selections'][0]['perk']);
        $newMatchs->setPerk2(($data['info']['participants']['perks']['styles'][1]['style']));
        $newMatchs->setWardsPlaced($data['info']['participants']['wardsPlaced']);
        $newMatchs->setWin($data['info']['participants']['win']);
        $newMatchs->setPuuid($puuid);
        $newMatchs->setMatchid($data['metadata']['matchId']);

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
    //        
    //    }
}
