<?php

namespace App\Service;

class UtilsService
{

  public function getArrayItems(array $data): array
  {
    $items = array();
    // dd($data);
    for ($i = 0; $i < 7; $i++) {
      array_push($items, $data['item' . $i]);
    }

    return $items;
  }

  public function formatUsername(string $username): string
  {
    $username = str_replace(" ", "", strtolower($username));
    return $username;
  }

  public function createArrayGame(object $dirtyArray): array
  {
    $game = [
      "id" => $dirtyArray->getId(),
      "Matchs" => $dirtyArray->getMatchid(),
      "gameLength" => $dirtyArray->getGameLenght(),
      "gameMode" => $dirtyArray->getGameMode(),
      "champLevel" => $dirtyArray->getChampLevel(),
      "championId" =>  $dirtyArray->getChampionId(),
      "deaths" =>  $dirtyArray->getDeaths(),
      "kills" =>  $dirtyArray->getKills(),
      "assists" =>  $dirtyArray->getAssists(),
      "championName" =>  $dirtyArray->getChampionName(),
      "item" =>  $dirtyArray->getItem(),
      "sum_1" => $dirtyArray->getSum1(),
      "sum_2" => $dirtyArray->getSum2(),
      "perk_1" => $dirtyArray->getPerk1(),
      "perk_2" => $dirtyArray->getPerk2(),
      "wardsPlaced" => $dirtyArray->getWardsPlaced(),
      "win" => $dirtyArray->isWin(),
      "puuid" => $dirtyArray->getPuuid(),
      "Matchid" => $dirtyArray->getMatchid(),
    ];

    return $game;
  }

  public function serializeGameObject($data, $items, $puuid): array
  {
    $newMatchs = [
      "gameMode" => $data['info']['gameMode'],
      "gameLength" => $data['info']['gameDuration'],
      "champLevel" => $data['info']['participants']['champLevel'],
      "championId" => $data['info']['participants']['championId'],
      "deaths" => $data['info']['participants']['deaths'],
      "kills" => $data['info']['participants']['kills'],
      "assists" => $data['info']['participants']['assists'],
      "championName" => $data['info']['participants']['championName'],
      "items" => $items,
      "sum_1" => $data['info']['participants']['summoner1Id'],
      "sum_2" => $data['info']['participants']['summoner2Id'],
      "perk_1" => $data['info']['participants']['perks']['styles'][0]['selections'][0]['perk'],
      "perk_2" => $data['info']['participants']['perks']['styles'][1]['style'],
      "wardsPlaced" => $data['info']['participants']['wardsPlaced'],
      "win" => $data['info']['participants']['win'],
      "puuid" => $puuid,
      "matchId" => $data['metadata']['matchId'],
    ];

    return $newMatchs;
  }
}
