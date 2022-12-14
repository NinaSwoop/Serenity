<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $progressbarColor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $progressColor = null;

    public function __construct()
    {
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

    public function getProgressbarColor(): ?string
    {
        return $this->progressbarColor;
    }

    public function setProgressbarColor(?string $progressbarColor): self
    {
        $this->progressbarColor = $progressbarColor;

        return $this;
    }

    public function getProgressColor(): ?string
    {
        return $this->progressColor;
    }

    public function setProgressColor(?string $progressColor): self
    {
        $this->progressColor = $progressColor;

        return $this;
    }
}
