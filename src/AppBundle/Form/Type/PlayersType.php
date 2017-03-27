<?php
/**
 * Created by PhpStorm.
 * User: mvilches
 * Date: 27/03/17
 * Time: 22:45
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\Player;
use AppBundle\Service\PlayerManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayersType extends AbstractType
{
    protected $manager;

    public function __construct(PlayerManager $manager)
    {
        $this->manager = $manager;
    }

    protected function getPlayers()
    {
        $players = $this->manager->get();
        $collection = ["" => "Seleccionar un Jugador"];
        /** @var Player $player */
        foreach ($players as $player) {
            $collection[ $player->getId() ] = $player->getName();
        }

        return $collection;
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return ChoiceType::class;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return "playerSelect";
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => $this->getPlayers()
        ]);
    }
}