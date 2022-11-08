<?php

namespace App\Entity;

use App\Repository\MatchResumeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchResumeRepository::class)]
class MatchResume
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'match_resume')]
    #[ORM\JoinColumn(nullable: false)]
    private ?player $player = null;

    #[ORM\Column(length: 255)]
    private ?string $game_mode = null;

    #[ORM\Column]
    private ?float $game_end_timestamp = null;

    #[ORM\Column]
    private ?float $game_lenght = null;

    #[ORM\Column]
    private ?float $kda = null;

    #[ORM\Column]
    private ?int $champ_level = null;

    #[ORM\Column]
    private ?int $champion_id = null;

    #[ORM\Column]
    private ?int $deaths = null;

    #[ORM\Column]
    private ?int $kills = null;

    #[ORM\Column]
    private ?int $assists = null;

    #[ORM\Column(length: 255)]
    private ?string $champion_name = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $item = [];

    #[ORM\Column]
    private ?int $sum_1 = null;

    #[ORM\Column]
    private ?int $sum_2 = null;

    #[ORM\Column]
    private ?int $perk_1 = null;

    #[ORM\Column]
    private ?int $perk_2 = null;

    #[ORM\Column]
    private ?int $wards_placed = null;

    #[ORM\Column]
    private ?bool $win = null;

    #[ORM\Column(length: 255)]
    private ?string $puuid = null;

    #[ORM\Column(length: 255)]
    private ?string $matchid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?player
    {
        return $this->player;
    }

    public function setPlayer(?player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getGameMode(): ?string
    {
        return $this->game_mode;
    }

    public function setGameMode(string $game_mode): self
    {
        $this->game_mode = $game_mode;

        return $this;
    }

    public function getGameEndTimestamp(): ?float
    {
        return $this->game_end_timestamp;
    }

    public function setGameEndTimestamp(float $game_end_timestamp): self
    {
        $this->game_end_timestamp = $game_end_timestamp;

        return $this;
    }

    public function getGameLenght(): ?float
    {
        return $this->game_lenght;
    }

    public function setGameLenght(float $game_lenght): self
    {
        $this->game_lenght = $game_lenght;

        return $this;
    }

    public function getKda(): ?float
    {
        return $this->kda;
    }

    public function setKda(float $kda): self
    {
        $this->kda = $kda;

        return $this;
    }

    public function getChampLevel(): ?int
    {
        return $this->champ_level;
    }

    public function setChampLevel(int $champ_level): self
    {
        $this->champ_level = $champ_level;

        return $this;
    }

    public function getChampionId(): ?int
    {
        return $this->champion_id;
    }

    public function setChampionId(int $champion_id): self
    {
        $this->champion_id = $champion_id;

        return $this;
    }

    public function getDeaths(): ?int
    {
        return $this->deaths;
    }

    public function setDeaths(int $deaths): self
    {
        $this->deaths = $deaths;

        return $this;
    }

    public function getKills(): ?int
    {
        return $this->kills;
    }

    public function setKills(int $kills): self
    {
        $this->kills = $kills;

        return $this;
    }

    public function getAssists(): ?int
    {
        return $this->assists;
    }

    public function setAssists(int $assists): self
    {
        $this->assists = $assists;

        return $this;
    }

    public function getChampionName(): ?string
    {
        return $this->champion_name;
    }

    public function setChampionName(string $champion_name): self
    {
        $this->champion_name = $champion_name;

        return $this;
    }

    public function getItem(): array
    {
        return $this->item;
    }

    public function setItem(array $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getSum1(): ?int
    {
        return $this->sum_1;
    }

    public function setSum1(int $sum_1): self
    {
        $this->sum_1 = $sum_1;

        return $this;
    }

    public function getSum2(): ?int
    {
        return $this->sum_2;
    }

    public function setSum2(int $sum_2): self
    {
        $this->sum_2 = $sum_2;

        return $this;
    }

    public function getPerk1(): ?int
    {
        return $this->perk_1;
    }

    public function setPerk1(int $perk_1): self
    {
        $this->perk_1 = $perk_1;

        return $this;
    }

    public function getPerk2(): ?int
    {
        return $this->perk_2;
    }

    public function setPerk2(int $perk_2): self
    {
        $this->perk_2 = $perk_2;

        return $this;
    }

    public function getWardsPlaced(): ?int
    {
        return $this->wards_placed;
    }

    public function setWardsPlaced(int $wards_placed): self
    {
        $this->wards_placed = $wards_placed;

        return $this;
    }

    public function isWin(): ?bool
    {
        return $this->win;
    }

    public function setWin(bool $win): self
    {
        $this->win = $win;

        return $this;
    }

    public function getPuuid(): ?string
    {
        return $this->puuid;
    }

    public function setPuuid(string $puuid): self
    {
        $this->puuid = $puuid;

        return $this;
    }

    public function getMatchid(): ?string
    {
        return $this->matchid;
    }

    public function setMatchid(string $matchid): self
    {
        $this->matchid = $matchid;

        return $this;
    }
}
