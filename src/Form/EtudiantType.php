<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EtudiantType extends AbstractType
{
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $etudiant = new Etudiant();
        $pass = 'passer123';
        $password = $this->hasher->hashPassword($etudiant, $pass);
        $builder
            ->add('nonComplet')
            ->add('login')
            ->add('password',HiddenType::class,
            [
                'attr' => ['value' => $password]
            ])
            ->add('sexe',ChoiceType::class,[
                "choices" =>[
                    'Masculin'=>'1',
                    'feminin'=>'0',
                ]

            ])
            ->add('adresse')
            ->add('Inscription',SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
