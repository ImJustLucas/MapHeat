<?php

namespace App\Controller;

use App\Repository\PlayerRepository;
use App\Repository\MatchResumeRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class GamesResumeController extends AbstractController
{
	#[Route('/games/{username}', name: 'app_games_resume', methods: ['GET'])]
	public function index(PlayerRepository $PlayerRepository, string $username): JsonResponse
	{
		$username = str_replace(" ", "", strtolower($username));
		$players = $PlayerRepository->findAll();
		$gamer = null;
		foreach ($players as $player) {
			$playersName = $player->getName();
			$playersName = str_replace(" ", "", strtolower($playersName));
			if ($username === $playersName) {
				$gamer = $player;
			}
		}

		if (empty($gamer) || is_null($gamer)) {

			$httpClient = HttpClient::create();
			$raw = $httpClient->request('GET', 'https://euw1.api.riotgames.com/lol/summoner/v4/summoners/by-name/' . $username . '?api_key=' . $this->getParameter('app.riot_api_key'));
			$jsonAPI = json_decode($raw->getContent(), true);

			$raw = $httpClient->request('GET', 'https://europe.api.riotgames.com/lol/match/v5/matches/by-puuid/' . $jsonAPI['puuid'] . '/ids?start=0&count=20&api_key=' . $this->getParameter('app.riot_api_key'));
			$matchsID = json_decode($raw->getContent(), true);

			$jsonAPI['matchsID'] = $matchsID;
			$PlayerRepository->addPlayer($jsonAPI);

			$result = $jsonAPI;
			$result['where'] = "Riot API";
		} else {
			$result = [
				"username" => $gamer->getName(),
				"PUUID" => $gamer->getPUUID(),
				"icon" => $gamer->getProfilIconId(),
				"summonersLvl" => $gamer->getSummonerLV(),
				"matchID" => $gamer->getMatchsID(),
				"where" => "database"
			];
		}

		return $this->json([
			'message' => 'Get the resume of the last X games',
			'username' => $username,
			'result' => $result
		]);
	}

	#[Route('/gameResumes/{username}', name: 'games_resume', methods: ['GET'])]
	public function gameResume(MatchResumeRepository $matchResumeRepository, PlayerRepository $PlayerRepository, string $username): JsonResponse
	{
		$username = str_replace(" ", "", strtolower($username));
		$players = $PlayerRepository->findAll();
		$gamer = null;
		foreach ($players as $player) {
			$playersName = $player->getName();
			$playersName = str_replace(" ", "", strtolower($playersName));
			if ($username === $playersName) {
				$gamer = $player;
			}
		}

		$httpClient = HttpClient::create();
		foreach ($gamer->getMatchsID() as $matchid) {
			$httpClient = HttpClient::create();
			$raw = $httpClient->request('GET', 'https://europe.api.riotgames.com/lol/match/v5/matches/' . $matchid . '?api_key=' . $this->getParameter('app.riot_api_key'));
			$MatchResumeAPI = json_decode($raw->getContent(), true);
		}

		$MatchPlayerpuuid = $MatchResumeAPI['result']['matchID']['info']['participants']['puuid'];
		foreach ($MatchPlayerpuuid as $matchResumepuuid) {
			if ($gamer->getPUUID() === $matchResumepuuid) {
				// $matchResumeRepository->addMatchResume($MatchResumeAPI);
				$result = [
					"matchID" => $matchResumepuuid,
					// "where" => "database"
				];
			}
		}

		return $this->json([
			// 'message' => 'Get the resume of the last X games',
			// 'username' => $username,
			'result' => $result
		]);
	}
}
