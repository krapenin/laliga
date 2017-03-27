<?php
/**
 * Created by PhpStorm.
 * User: mvilches
 * Date: 27/03/17
 * Time: 19:55
 */

namespace AppBundle\Form;


use AppBundle\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("name", TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Player::class
        ]);
    }
}