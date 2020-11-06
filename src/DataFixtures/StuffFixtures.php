<?php

namespace App\DataFixtures;

use App\Entity\Stuff;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class StuffFixtures extends Fixture
{
    const StuffLength = 10;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i <= self::StuffLength; ++$i) {
            $stuff = new Stuff();
            $stuff->setName($faker->domainWord);
            $stuff->setLendAt($faker->dateTime);
            $stuff->setReturnedAt($faker->boolean(25) ? $faker->dateTime : null);
            $manager->persist($stuff);
        }

        $manager->flush();
    }
}
