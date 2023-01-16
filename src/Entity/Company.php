<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
#[ApiResource(
    operations:[
        new GetCollection(normalizationContext: ['groups' => ['company_read']]),
        new Get(normalizationContext: ['groups' => ['id_company_read', 'company_read']]),
        new Post(denormalizationContext: ['groups' => ['company_write']]),
    ]
)]
class Company
{
    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param Collection $flights
     */
    public function setFlights(Collection $flights): void
    {
        $this->flights = $flights;
    }
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['company_read', 'id_flight_read'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['company_read', 'company_write', 'id_flight_read', 'flight_read'])]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Flight::class)]
    #[Groups(['id_company_read'])]
    private Collection $flights;

    public function __construct()
    {
        $this->flights = new ArrayCollection();
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

    /**
     * @return Collection<int, Flight>
     */
    public function getFlights(): Collection
    {
        return $this->flights;
    }

    public function addFlight(Flight $flight): self
    {
        if (!$this->flights->contains($flight)) {
            $this->flights->add($flight);
            $flight->setCompany($this);
        }

        return $this;
    }

    public function removeFlight(Flight $flight): self
    {
        if ($this->flights->removeElement($flight)) {
            // set the owning side to null (unless already changed)
            if ($flight->getCompany() === $this) {
                $flight->setCompany(null);
            }
        }

        return $this;
    }
}
