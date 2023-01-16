<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends Fixture
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function load(ObjectManager $manager): void
    {

        for ($count = 0; $count < 10; ++$count) {

            $company = new Company();
            //$company->setId(++$count);
            $company->setName('Company '. $count + 1);
            $manager->persist($company);
        }
        $manager->flush();
    }
}
