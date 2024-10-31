<?php

namespace App\Entity;

use App\Repository\RadioListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RadioListRepository::class)]
class RadioList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $frequency = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;
    public function __toString(): string
    {
        return $this->id.' '.$this->name.' '.$this->frequency.' '.$this->genre;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFrequency(): ?float
    {
        return $this->frequency;
    }

    public function setFrequency(float $frequency): static
    {
        $this->frequency = $frequency;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }
}
