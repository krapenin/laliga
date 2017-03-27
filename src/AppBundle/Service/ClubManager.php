<?php
/**
 * Created by PhpStorm.
 * User: mvilches
 * Date: 27/03/17
 * Time: 20:01
 */

namespace AppBundle\Service;

use AppBundle\Entity\Club;
use Doctrine\Common\Persistence\ObjectManager;
use Monolog\Logger;

//TODO deberiamos implementar de una custom interfaz para estos metodos o hacer general el manager según instancias
class ClubManager
{
    /** @var ObjectManager $em */
    protected $em;
    protected $logger;

    public function __construct(ObjectManager $em, Logger $logger)
    {
        $this->em = $em;
    }

    public function update(Club $club)
    {
        $this->em->persist($club);
        $this->em->flush();
    }

    public function get($id = null)
    {
        if (!$id) {
            return $this->getRepository()->findAll();
        }

        $club =  $this->getRepository()->find($id);

        if (!$club) {
            return false;
        }

        return $club;
    }

    protected function getRepository()
    {
        return $this->em->getRepository("AppBundle:Club");
    }
}