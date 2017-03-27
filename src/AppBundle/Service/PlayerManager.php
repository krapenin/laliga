<?php
/**
 * Created by PhpStorm.
 * User: mvilches
 * Date: 27/03/17
 * Time: 20:01
 */

namespace AppBundle\Service;


use AppBundle\Entity\Player;
use Doctrine\Common\Persistence\ObjectManager;
use Monolog\Logger;
use Symfony\Component\Form\Test\FormInterface;

class PlayerManager
{
    /** @var ObjectManager $em */
    protected $em;
    protected $logger;

    public function __construct(ObjectManager $em, Logger $logger)
    {
        $this->em = $em;
    }

    public function update(Player $player)
    {
        $this->em->persist($player);
        $this->em->flush();
    }

    public function get($id = null)
    {
        if (!$id) {
            return $this->getRepository()->findAll();
        }

        $player =  $this->getRepository()->find($id);

        if (!$player) {
            return false;
        }

        return $player;
    }

    public function delete($id)
    {
        try {
            $player = $this->get($id);
            $this->em->remove($player);
            $this->em->flush();
        } catch(\Exception $e) {
            return false;
        }

        return true;
    }

    protected function getRepository()
    {
        return $this->em->getRepository("AppBundle:Player");
    }
}