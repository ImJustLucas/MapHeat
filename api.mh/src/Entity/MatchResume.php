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

    #[ORM\ManyToOne(inversedBy: 'Player')]
    #[ORM\JoinColumn(nullable: false)]
    private ?player $player = null;

    #[ORM\OneToOne(mappedBy: 'matchs', cascade: ['persist', 'remove'])]
    private ?MatchTimeline $Matchs = null;

    #[ORM\Column(length: 255)]
    private ?string $gameMode = null;

    #[ORM\Column]
    private ?float $gameEndTimestamp = null;

    #[ORM\Column]
    private ?float $gameLength = null;

    #[ORM\Column]
    private ?float $kda = null;

    #[ORM\Column]
    private ?int $champLevel = null;

    #[ORM\Column]
    private ?int $championId = null;

    #[ORM\Column]
    private ?int $deaths = null;

    #[ORM\Column]
    private ?int $kills = null;

    #[ORM\Column]
    private ?int $assists = null;

    #[ORM\Column(length: 255)]
    private ?string $championName = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $item = [];

    #[ORM\Column(length: 255)]
    private ?string $lane = null;

    #[ORM\Column]
    private ?int $wardsPlaced = null;

    #[ORM\Column]
    private ?bool $win = null;

    #[ORM\Column(length: 255)]
    private ?string $puuid = null;

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

    public function getMatchs(): ?MatchTimeline
    {
        return $this->Matchs;
    }

    public function setMatchs(MatchTimeline $Matchs): self
    {
        // set the owning side of the relation if necessary
        if ($Matchs->getMatchs() !== $this) {
            $Matchs->setMatchs($this);
        }

        $this->Matchs = $Matchs;

        return $this;
    }

    public function getGameMode(): ?string
    {
        return $this->gameMode;
    }

    public function setGameMode(string $gameMode): self
    {
        $this->gameMode = $gameMode;

        return $this;
    }

    public function getGameEndTimestamp(): ?float
    {
        return $this->gameEndTimestamp;
    }

    public function setGameEndTimestamp(float $gameEndTimestamp): self
    {
        $this->gameEndTimestamp = $gameEndTimestamp;

        return $this;
    }

    public function getGameLength(): ?float
    {
        return $this->gameLength;
    }

    public function setGameLength(float $gameLength): self
    {
        $this->gameLength = $gameLength;

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
        return $this->champLevel;
    }

    public function setChampLevel(int $champLevel): self
    {
        $this->champLevel = $champLevel;

        return $this;
    }

    public function getChampionId(): ?int
    {
        return $this->championId;
    }

    public function setChampionId(int $championId): self
    {
        $this->championId = $championId;

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
        return $this->championName;
    }

    public function setChampionName(string $championName): self
    {
        $this->championName = $championName;

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

    public function getLane(): ?string
    {
        return $this->lane;
    }

    public function setLane(string $lane): self
    {
        $this->lane = $lane;

        return $this;
    }

    public function getWardsPlaced(): ?int
    {
        return $this->wardsPlaced;
    }

    public function setWardsPlaced(int $wardsPlaced): self
    {
        $this->wardsPlaced = $wardsPlaced;

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
}
