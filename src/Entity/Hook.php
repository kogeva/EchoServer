<?php

namespace App\Entity;

use App\Repository\HookRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: HookRepository::class)]
#[ORM\Table(name: 'hooks')]
class Hook
{
//    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(name: 'query_params', type: 'json')]
    private array $queryParams = [];

    #[ORM\Column(type: 'json')]
    private array $body = [];

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    protected \DateTime $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    protected \DateTime $updated;

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

    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }

    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }

    public function setUpdated(\DateTime $updated): void
    {
        $this->updated = $updated;
    }
}
