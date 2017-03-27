<?php
/**
 * Created by PhpStorm.
 * User: mvilches
 * Date: 27/03/17
 * Time: 20:01
 */

namespace AppBundle\Services;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;

class PlayerManager
{
    /** @var ObjectManager $em */
    protected $em;
    protected $logger;

    public function __construct(ObjectManager $em, Logger $logger)
    {
        $this->em = $em;

    }


}