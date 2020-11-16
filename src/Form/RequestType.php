<?php

namespace App\Form;

use App\Entity\Requete;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RequestType extends AbstractType
{
    /*
     * methode qui crée le formulaire dans la view.
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', TextType::class)
            ->add('token', TextType::class, array('required' => false))
            ->add('method', ChoiceType::class, [
                'choices' => [
                    'GET' => "GET",
                    'POST' => "POST",

                ],
            ])

            ->add('submit', SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Requete::class,
        ]);
    }
}
