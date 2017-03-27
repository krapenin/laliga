<?php
/**
 * Created by PhpStorm.
 * User: mvilches
 * Date: 27/03/17
 * Time: 19:23
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends Controller
{
    public function listAction() {

        $em = $this->getDoctrine()->getManager();
        $players = $em->getRepository("AppBundle:Player")->findAll();

        return $this->render('players/index.html.twig', [
            "players" => $players
        ]);
    }



}