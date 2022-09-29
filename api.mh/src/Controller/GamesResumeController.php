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
	public function index(PlayerRepository $PlayerRepository, MatchResumeRepository $MatchResumeRepository, string $username): JsonResponse
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

		//Find match
		$matchs = [];
		$matchperso = [];
		$e = 0;
		foreach ($user['matchsID'] as $matchID) {
			if($e > 5){
				break;
			}
			$matche = $MatchResumeRepository->findOneBy(['Matchid' => $matchID]);
			
			if (empty($match) || is_null($match)) {
				$httpClient = HttpClient::create();
				$raw = $httpClient->request('GET', 'https://europe.api.riotgames.com/lol/match/v5/matches/' . $matchID . '?api_key=' . $this->getParameter('app.riot_api_key'));
				$match = json_decode($raw->getContent(), true);
				$player_in_match = [];
				foreach ($match['info']['participants'] as $participant) {
					if ($participant['puuid'] === $user['PUUID']) {
						$player_in_match = $participant;
					}
				}
				$items = array();
				for ($i = 0; $i < 7; $i++) {
					array_push($items, $player_in_match['item' . $i]);
				}
				$matchperso = array(
					"gameMode" => $match['info']['gameMode'],
					"gameEndTimestamp" => $match['info']['gameEndTimestamp'],
					"gameLength" => $player_in_match['challenges']['gameLength'],
					"kda" => $player_in_match['challenges']['kda'],
					"champLevel" => $player_in_match['champLevel'],
					"championId" => $player_in_match['championId'],
					"deaths" => $player_in_match['deaths'],
					"kills" => $player_in_match['kills'],
					"assists" => $player_in_match['assists'],
					"championName" => $player_in_match['championName'],
					"items" => $items,
					"lane" => $player_in_match['lane'],
					"wardsPlaced" => $player_in_match['wardsPlaced'],
					"win" => $player_in_match['win'],
					"puuid" => $player_in_match['puuid'],
					"matchId" => $match['metadata']['matchId'],
					"player_id" => $user['PUUID'],
				);
				array_push($matchs, $matchperso);
				$MatchResumeRepository->addMatchResume($matchperso);
				
			} else {
				$array = [
					"id" => $matche->getId(),
					"player" => $matche->getPlayer(), 
					"Matchs" => $matche->getMatchs(), 
					"gameMode" => $matche->getGameMode(), 
					"gameEndTimestamp" => $matche->getGameEndTimestamp(), 
					"gameLength" => $matche->getGameLength(), 
					"kda" => $matche->getKda(), 
					"champLevel" => $matche->getChampLevel(), 
					"championId" =>  $matche->getChampionId(), 
					"deaths" =>  $matche->getDeaths(), 
					"kills" =>  $matche->getKills(), 
					"assists" =>  $matche->getAssists(), 
					"championName" =>  $matche->getChampionName(), 
					"item" =>	$matche->getItem(), 
					"lane" => $matche->getLane(), 
					"wardsPlaced" => $matche->getWardsPlaced(), 
					"win" => $matche->isWin(), 
					"puuid" => $matche->getPuuid(), 
					"Matchid" => $matche->getMatchid(), 
				];
				array_push($matchs, $array);
			}
			$e++;
			
		}
		return $this->json([
			'message' => 'Get the resume of the last 5 games',
			'username' => $username,
			'user' => $user,
			'matchs' => $matchs,
		]);
	}
}
