<?php

namespace App\Entity;

use App\Repository\HookRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HookRepository::class)]
class Hook
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private array $queryParams = [];

    #[ORM\Column]
    private array $body = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function setQueryParams(array $queryParams): static
    {
        $this->queryParams = $queryParams;

        return $this;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function setBody(array $body): static
    {
        $this->body = $body;

        return $this;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }
}
