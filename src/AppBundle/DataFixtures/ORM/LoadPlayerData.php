<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Player;

class LoadPlayerData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $player = new Player();
        $player->setName('Marcos Vilches');

        $manager->persist($player);
        $manager->flush();

        $this->addReference('player-1', $player);
    }

    public function getOrder()
    {
        return 1;
    }

    public function listAction() {

        $clubManager = $this->get('club.manager');

        return $this->render('club/index.html.twig', [
            "players" => $clubManager->get()
        ]);
    }
}
