<?php

namespace App\Entity;

use App\Repository\MatchTimelineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchTimelineRepository::class)]
class MatchTimeline
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'Matchs', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?MatchResume $matchs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatchs(): ?MatchResume
    {
        return $this->matchs;
    }

    public function setMatchs(MatchResume $matchs): self
    {
        $this->matchs = $matchs;

        return $this;
    }
}
