<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Inscription;
use App\Entity\AnneeScolaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('date')
            // ->add('etat')
            ->add('classe',EntityType::class,[
                'class' => Classe::class,
                'choice_label' => function($classe)
                {
                    return $classe->getLibelle();
                },
                'multiple' => false
            ])
            // ->add('ac')
            ->add('anneeScolaire',EntityType::class,[
                'class' => AnneeScolaire::class,
                'choice_label' => function($anneeScolaire)
                {
                    return $anneeScolaire->getLibelle();
                }
            ])
            ->add('etudiant',EtudiantType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
