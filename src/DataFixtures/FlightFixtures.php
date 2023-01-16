<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Flight;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class FlightFixtures extends Fixture
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function getDependencies()
    {
        return [
            CompanyFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $gates = ['A', 'B', 'C', 'D', null];
        $faker = Faker\Factory::create('fr_FR');
        $companies = $this->em->getRepository(Company::class)->findAll();

        for ($count = 0; $count < 12; ++$count) {

            $flight = new Flight();
            //$flight->setId(++$count);
            $flight->setFlightNumber('AA'.$count);
            $flight->setDestination($faker->country);
            $flight->setDeparture(\DateTime::createFromFormat('Y-m-d', $faker->date('2023-03-' . $count)));
            $flight->setGate($faker->randomElement($gates));
            $flight->setCompany($faker->randomElement($companies));
            $manager->persist($flight);
        }
        $manager->flush();
    }
}
