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
    private ?string $puuid = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $profil_icon_id = null;

    #[ORM\Column]
    private ?int $summoner_lv = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $matchs_id = [];

    public function __construct()
    {
        $this->match_resume = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return Collection<int, MatchResume>
     */
    public function getMatchResume(): Collection
    {
        return $this->match_resume;
    }

    public function addMatchResume(MatchResume $matchResume): self
    {
        if (!$this->match_resume->contains($matchResume)) {
            $this->match_resume->add($matchResume);
            $matchResume->setPlayer($this);
        }

        return $this;
    }

    public function removeMatchResume(MatchResume $matchResume): self
    {
        if ($this->match_resume->removeElement($matchResume)) {
            // set the owning side to null (unless already changed)
            if ($matchResume->getPlayer() === $this) {
                $matchResume->setPlayer(null);
            }
        }

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
        return $this->profil_icon_id;
    }

    public function setProfilIconId(int $profil_icon_id): self
    {
        $this->profil_icon_id = $profil_icon_id;

        return $this;
    }

    public function getSummonerLv(): ?int
    {
        return $this->summoner_lv;
    }

    public function setSummonerLv(int $summoner_lv): self
    {
        $this->summoner_lv = $summoner_lv;

        return $this;
    }

    public function getMatchsId(): array
    {
        return $this->matchs_id;
    }

    public function setMatchsId(array $matchs_id): self
    {
        $this->matchs_id = $matchs_id;

        return $this;
    }
}
