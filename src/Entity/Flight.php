<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Repository\FlightRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FlightRepository::class)]
#[ApiResource(
    operations:[
        new GetCollection(normalizationContext: ['groups' => ['flight_read']]),
        new Get(normalizationContext: ['groups' => ['id_flight_read', 'flight_read']]),
        new Post(denormalizationContext: ['groups' => ['flight_write']]),
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['company' => 'exact', 'flightNumber' => 'exact', 'company.name' => 'partial'])]
#[ApiFilter(DateFilter::class, properties: ['departure'])]
#[ApiFilter(OrderFilter::class, properties: ['departure' => 'asc'])]
class Flight
{
    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['flight_read', 'id_company_read'])]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    #[Groups(['flight_read', 'flight_write', 'id_company_read'])]
    private ?string $flightNumber = null;

    #[ORM\Column(length: 50)]
    #[Groups(['flight_read', 'flight_write', 'id_company_read'])]
    private ?string $destination = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['flight_read', 'flight_write', 'id_company_read'])]
    private ?\DateTimeInterface $departure = null;

    #[ORM\Column(length: 5, nullable: true)]
    #[Groups(['flight_read', 'flight_write'])]
    private ?string $gate = null;

    #[ORM\ManyToOne(inversedBy: 'flights')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['flight_read', 'flight_write'])]
    private ?Company $company = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlightNumber(): ?string
    {
        return $this->flightNumber;
    }

    public function setFlightNumber(string $flightNumber): self
    {
        $this->flightNumber = $flightNumber;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDeparture(): ?\DateTimeInterface
    {
        return $this->departure;
    }

    public function setDeparture(\DateTimeInterface $departure): self
    {
        $this->departure = $departure;

        return $this;
    }

    public function getGate(): ?string
    {
        return $this->gate;
    }

    public function setGate(?string $gate): self
    {
        $this->gate = $gate;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
