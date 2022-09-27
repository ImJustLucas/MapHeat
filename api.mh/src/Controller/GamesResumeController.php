<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\MatchResume;

use App\Repository\PlayerRepository;
use App\Repository\MatchResumeRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class GamesResumeController extends AbstractController
{
	#[Route('/games/{username}', name: 'app_games_resume', methods: ['GET'])]
	public function index(EntityManagerInterface $entityManager, PlayerRepository $PlayerRepository, string $username): JsonResponse
	{
		$username = str_replace(" ", "", strtolower($username));
		$players = $PlayerRepository->findAll();
		$gamer = null;
		foreach ($players as $player) {
			$playersName = $player->getName();
			$playersName = str_replace(" ", "", strtolower($playersName));
			if ($username === $playersName) {
				$gamer = $player;
				// dd($gamer);
			}
		}

		if (empty($gamer) || is_null($gamer)) {

			$httpClient = HttpClient::create();
			$raw = $httpClient->request('GET', 'https://euw1.api.riotgames.com/lol/summoner/v4/summoners/by-name/' . $username . '?api_key=' . $this->getParameter('app.riot_api_key'));
			$jsonAPI = json_decode($raw->getContent(), true);

			$newPlayer = new Player();
			$newPlayer->setName($jsonAPI['name']);
			$newPlayer->setPUUID($jsonAPI['puuid']);
			$newPlayer->setProfilIconId($jsonAPI['profileIconId']);
			$newPlayer->setSummonerLV($jsonAPI['summonerLevel']);
			$result = $jsonAPI;
			$result['where'] = "Riot API";

			$entityManager->persist($newPlayer);
			$entityManager->flush();
		} else {
			$result = [
				"username" => $gamer->getName(),
				"PUUID" => $gamer->getPUUID(),
				"icon" => $gamer->getProfilIconId(),
				"summonersLvl" => $gamer->getSummonerLV(),
				"where" => "database"
			];
		}



		return $this->json([
			'message' => 'Get the resume of the last X games',
			'username' => $username,
			'result' => $result
		]);
	}
}
