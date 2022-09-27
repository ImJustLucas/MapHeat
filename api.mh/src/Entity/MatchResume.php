<?php

namespace App\Entity;

use App\Repository\MatchResumeRepository;
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
}
