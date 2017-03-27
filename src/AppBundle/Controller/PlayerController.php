<?php
/**
 * Created by PhpStorm.
 * User: mvilches
 * Date: 27/03/17
 * Time: 19:23
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Player;
use AppBundle\Form\PlayerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PlayerController extends Controller
{
    public function listAction() {

        $playerManager = $this->get('player.manager');

        return $this->render('players/index.html.twig', [
            "players" => $playerManager->get()
        ]);
    }

    //TODO Refactorizar handler formulario
    public function newAction(Request $request)
    {
        $player = new Player();

        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $playerManager = $this->get('player.manager');
            $playerManager->update($player);

            return $this->redirect($this->generateUrl("laliga_players"));
        }

        return $this->render('players/new.html.twig', [
            "form" => $form->createView()
        ]);
    }

    public function editAction($id, Request $request)
    {
        $playerManager = $this->get('player.manager');
        $player = $playerManager->get($id);

        if (!$player) {
            $this->addError("Player Not Found");
            return $this->redirect($this->generateUrl("laliga_players"));
        }

        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $playerManager = $this->get('player.manager');
            $playerManager->update($player);
            return $this->redirect($this->generateUrl("laliga_players"));
        }

        return $this->render('players/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    public function deleteAction($id)
    {
        $playerManager = $this->get('player.manager');

        if (!$playerManager->delete($id)) {
            $this->addError("Couldnt delete player");
        }

        $this->addSuccess("Player deleted");

        return $this->redirect($this->generateUrl("laliga_players"));
    }

    protected function addError($msg)
    {
        //Listener para las excepciones, enviar errores automaticamente
        $this->get('session')->getFlashBag()->add("error", $msg);
    }

    protected function addSuccess($msg)
    {
        $this->get('session')->getFlashBag()->add("success", $msg);
    }
}