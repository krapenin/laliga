<?php
/**
 * Created by PhpStorm.
 * User: mvilches
 * Date: 27/03/17
 * Time: 19:23
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Club;
use AppBundle\Entity\Player;
use AppBundle\Form\ClubType;
use AppBundle\Form\PlayerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClubController extends Controller
{

    //TODO Refactorizar handler formulario
    public function newAction(Request $request)
    {
        $club = new Club();

        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clubManager = $this->get('club.manager');
            $clubManager->update($club);
            return $this->redirect($this->generateUrl("laliga_club_list"));
        }

        return $this->render('club/new.html.twig', [
            "form" => $form->createView()
        ]);
    }

    public function listAction() {

        $clubManager = $this->get('club.manager');

        return $this->render('club/index.html.twig', [
            "clubs" => $clubManager->get()
        ]);
    }
}