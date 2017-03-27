<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Player;

class LoadPlayerData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new Player();
        $userAdmin->setName('Marcos Vilches');

        $manager->persist($userAdmin);
        $manager->flush();
    }
}
