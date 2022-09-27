<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\OneToMany(mappedBy: 'player', targetEntity: MatchResume::class, orphanRemoval: true)]
    private Collection $Player;

    #[ORM\Column(type: Types::ARRAY)]
    private array $MatchsID = [];

    public function __construct()
    {
        $this->Player = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, MatchResume>
     */
    public function getPlayer(): Collection
    {
        return $this->Player;
    }

    public function addPlayer(MatchResume $player): self
    {
        if (!$this->Player->contains($player)) {
            $this->Player->add($player);
            $player->setPlayer($this);
        }

        return $this;
    }

    public function removePlayer(MatchResume $player): self
    {
        if ($this->Player->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getPlayer() === $this) {
                $player->setPlayer(null);
            }
        }

        return $this;
    }

    public function getMatchsID(): array
    {
        return $this->MatchsID;
    }

    public function setMatchsID(array $MatchsID): self
    {
        $this->MatchsID = $MatchsID;

        return $this;
    }
}
