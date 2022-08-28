<?php

namespace App\Entity;

use App\Repository\BeerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BeerRepository::class)]
class Beer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Supplier::class, inversedBy: 'beers')]
    private Collection $supplier;

    #[ORM\ManyToOne(inversedBy: 'beers')]
    private ?TypeBeer $type = null;

    public function __construct()
    {
        $this->supplier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Supplier>
     */
    public function getSupplier(): Collection
    {
        return $this->supplier;
    }

    public function addSupplier(Supplier $supplier): self
    {
        if (!$this->supplier->contains($supplier)) {
            $this->supplier->add($supplier);
        }

        return $this;
    }

    public function removeSupplier(Supplier $supplier): self
    {
        $this->supplier->removeElement($supplier);

        return $this;
    }

    public function getType(): ?TypeBeer
    {
        return $this->type;
    }

    public function setType(?TypeBeer $type): self
    {
        $this->type = $type;

        return $this;
    }
}
