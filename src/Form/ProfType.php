<?php

namespace App\Form;

use App\Entity\Rp;
use App\Entity\Classe;
use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nonComplet')
            ->add('grade')
            // ->add('modules')
            ->add('classes',EntityType::class,[
                'class' => Classe::class,
                'choice_label' => function($classe)
                {
                    return $classe->getLibelle();
                },
                'multiple' => false,
                'mapped' => false
            ])
            ->add('rp',EntityType::class,[
                'class' => Rp::class,
                'choice_label' => function($rp)
                {
                    return $rp->getNonComplet();
                }
            ])
            ->add('AjouterProfesseur',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Professeur::class,
        ]);
    }
}
