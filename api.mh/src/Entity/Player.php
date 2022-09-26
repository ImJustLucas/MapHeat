<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 79)]
    private ?string $PUUID = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $profilIconId = null;

    #[ORM\Column]
    private ?float $summonerLV = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPUUID(): ?string
    {
        return $this->PUUID;
    }

    public function setPUUID(string $PUUID): self
    {
        $this->PUUID = $PUUID;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getProfilIconId(): ?int
    {
        return $this->profilIconId;
    }

    public function setProfilIconId(int $profilIconId): self
    {
        $this->profilIconId = $profilIconId;

        return $this;
    }

    public function getSummonerLV(): ?float
    {
        return $this->summonerLV;
    }

    public function setSummonerLV(float $summonerLV): self
    {
        $this->summonerLV = $summonerLV;

        return $this;
    }
}
