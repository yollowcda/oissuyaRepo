<?php

namespace App\Entity;

use App\Repository\VinylMixRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VinylMixRepository::class)]
class VinylMix
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $trackCount = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $vote = 0;

    public function __construct(){
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }


    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTrackCount(): ?int
    {
        return $this->trackCount;
    }

    public function setTrackCount(?int $trackCount): self
    {
        $this->trackCount = $trackCount;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getVote(): ?int
    {
        return $this->vote;
    }

    public function setVote(?int $vote): self
    {
        $this->vote = $vote;

        return $this;
    }

    public function getVotesString(): string {
        $prefix = $this->getVote() > 0 ? '+' : ($this->getVote() < 0 ? '-' : '');
        return sprintf("%s%d", $prefix, abs($this->getVote()));
    }

    public function getImageUrl(int $width): string {
        return sprintf('https://picsum.photos/id/%d/%d', ($this->getId() + 50) % 1000, $width);
    }
}
