<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\MatchResume;

use App\Repository\PlayerRepository;
use App\Repository\MatchResumeRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class GamesResumeController extends AbstractController
{
    #[Route('/games/{username}', name: 'app_games_resume', methods: ['GET'])]
    public function index( EntityManagerInterface $entityManager, PlayerRepository $PlayerRepository, string $username): JsonResponse
    {
        
        $player = $PlayerRepository->findOneBy(array('name' => $username));

        if(empty($player) || is_null($player)) {
            // $result = "User not found";
            $newPlayer = new Player();
            $newPlayer->setName("Lucas");
            $newPlayer->setPUUID("8Kw3JaqzFcIWqEqDr9Wjbni-CzzHKx_koUlRJOuxKdo-TbDLSXMskRMqTo6sx8_H2LGmEad_KOT7DQ");
            $newPlayer->setProfilIconId(3456);
            $newPlayer->setSummonerLV(388);

            $entityManager->persist($newPlayer);
            $entityManager->flush();

            $result = $newPlayer;
        } else {
            // $result = [
            //     "username" => $player->getName(),
            //     "PUUID" => $player->getPUUID(),
            //     "icon" => $player->getProfilIconId(),
            //     "summonersLvl" => $player->getSummonerLV(),
            // ];
            $result = [
                "username" => "Lucas",
                "PUUID" => "8Kw3JaqzFcIWqEqDr9Wjbni-CzzHKx_koUlRJOuxKdo-TbDLSXMskRMqTo6sx8_H2LGmEad_KOT7DQ",
                "icon" => "3456",
                "summonersLvl" => "388",
            ];
      
        }   

        return $this->json([
            'message' => 'Get the resume of the last X games',
            'username' => $username,
            'result' => $result
        ]);
    }
}