<?php

namespace App\Controller;

use App\Repository\PlayerRepository;
use App\Repository\MatchResumeRepository;

use App\Service\UtilsService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class GamesResumeController extends AbstractController
{
	#[Route('/games/{username}', name: 'app_games_resume', methods: ['GET'])]
	public function gamesByUsername(PlayerRepository $PlayerRepository, MatchResumeRepository $MatchResumeRepository, UtilsService $utils, string $username): JsonResponse
	{
		// Variables
		$httpClient = HttpClient::create();
		$username = $utils->formatUsername($username);
		$players = $PlayerRepository->findAll();
		$gamer = null;
		$matchs = [];
		$newMatch = [];
		$count = 0;
		$limit = 5;

		foreach ($players as $player) {
			$playersName = $utils->formatUsername($player->getName());
			if ($username === $playersName) {
				$gamer = $player;
			}
		}

		//Si c'est un nouveau joueurs, on le crée
		if (empty($gamer) || is_null($gamer)) {

			$raw = $httpClient->request('GET', 'https://euw1.api.riotgames.com/lol/summoner/v4/summoners/by-name/' . $username . '?api_key=' . $this->getParameter('app.riot_api_key'));
			$jsonAPI = json_decode($raw->getContent(), true);

			$raw = $httpClient->request('GET', 'https://europe.api.riotgames.com/lol/match/v5/matches/by-puuid/' . $jsonAPI['puuid'] . '/ids?start=0&count=5&api_key=' . $this->getParameter('app.riot_api_key'));
			$matchsID = json_decode($raw->getContent(), true);

			$jsonAPI['matchsID'] = $matchsID;
			$PlayerRepository->addPlayer($jsonAPI);

			$user = $jsonAPI;
			$user['where'] = "Riot API";
			$user['matchsID'] = $matchsID;
			$user['PUUID'] = $jsonAPI['puuid'];
		} else {
			$user = [
				"username" => $gamer->getName(),
				"PUUID" => $gamer->getPUUID(),
				"icon" => $gamer->getProfilIconId(),
				"summonersLvl" => $gamer->getSummonerLV(),
				"matchsID" => $gamer->getMatchsID(),
				"where" => "database"
			];
		}

		//Find matchs
		foreach ($user['matchsID'] as $matchID) {
			if ($count > $limit) {
				break;
			}

			$game = $MatchResumeRepository->findOneBy(['Matchid' => $matchID]);

			//Si la partie n'existe pas en BDD, on la créé
			if (empty($game) || is_null($game)) {
				$raw = $httpClient->request('GET', 'https://europe.api.riotgames.com/lol/match/v5/matches/' . $matchID . '?api_key=' . $this->getParameter('app.riot_api_key'));
				$match = json_decode($raw->getContent(), true);

				$player_in_match = [];

				foreach ($match['info']['participants'] as $participant) {
					if ($participant['puuid'] === $user['PUUID']) {
						$player_in_match = $participant;
					}
				}

				$match['info']['participants'] = $player_in_match;
				$items = $utils->getArrayItems($match['info']['participants']);

				$MatchResumeRepository->addMatchResume($match, $items, $user['PUUID']);
				$newMatch = $utils->serializeGameObject($match, $items, $user['PUUID']);
				array_push($matchs, $newMatch);
			} else {
				$addGame = $utils->createArrayGame($game);
				array_push($matchs, $addGame);
			}
			$count++;
		}
		return $this->json([
			'message' => 'Get the resume of the last 5 games',
			'username' => $username,
			'user' => $user,
			'matchs' => $matchs,
		]);
	}

	#[Route('/getAllUsername', name: 'get_all_username', methods: ['GET'])]
	public function getAllUsername(PlayerRepository $PlayerRepository): JsonResponse
	{
		$players = $PlayerRepository->findAll();
		$playersName = [];
		foreach ($players as $player) {
			array_push($playersName, $player->getName());
		}
		return $this->json([
			'message' => 'Get all username',
			'playersName' => $playersName,
		]);
	}
}
