<?php

namespace App\Service;

class UtilsService
{

  public function getArrayItems(array $data): array
  {
    $items = array();
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
      "player" => $dirtyArray->getPlayer(),
      "Matchs" => $dirtyArray->getMatchs(),
      "kda" => $dirtyArray->getKda(),
      "champLevel" => $dirtyArray->getChampLevel(),
      "championId" =>  $dirtyArray->getChampionId(),
      "deaths" =>  $dirtyArray->getDeaths(),
      "kills" =>  $dirtyArray->getKills(),
      "assists" =>  $dirtyArray->getAssists(),
      "championName" =>  $dirtyArray->getChampionName(),
      "item" =>  $dirtyArray->getItem(),
      "lane" => $dirtyArray->getLane(),
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
      "gameEndTimestamp" => $data['info']['gameEndTimestamp'],
      "gameLength" => $data['info']['participants']['challenges']['gameLength'],
      "kda" => $data['info']['participants']['challenges']['kda'],
      "champLevel" => $data['info']['participants']['champLevel'],
      "championId" => $data['info']['participants']['championId'],
      "deaths" => $data['info']['participants']['deaths'],
      "kills" => $data['info']['participants']['kills'],
      "assists" => $data['info']['participants']['assists'],
      "championName" => $data['info']['participants']['championName'],
      "items" => $items,
      "lane" => $data['info']['participants']['lane'],
      "wardsPlaced" => $data['info']['participants']['wardsPlaced'],
      "win" => $data['info']['participants']['win'],
      "puuid" => $puuid,
      "matchId" => $data['metadata']['matchId'],
    ];

    return $newMatchs;
  }
}
