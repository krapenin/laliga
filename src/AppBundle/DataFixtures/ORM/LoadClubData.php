<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Club;

class LoadClubData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $club = new Club();
        $club->setName('Real Betis Balompie');
        $club->setPhone("954425868");
        $club->addPlayer($this->getReference('player-1'));
        $club->setIsDeleted(false);

        $manager->persist($club);
        $manager->flush();

    }

    public function getOrder()
    {
        return 2;
    }
}
