<?php

namespace App\DataFixtures;

use App\Entity\Ac;
use App\Entity\Rp;
use Faker\Factory;
use App\Entity\Classe;
use App\Entity\Etudiant;
use App\Entity\Inscription;
use App\Entity\AnneeScolaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class InscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $ac = new Ac;
            $ac ->setNonComplet("Souleyemane Diallo");
            $ac -> setLogin("DialloSoulemane@gmail.com");
            $ac -> setPassword("DER");
            // $ac ->setEtat(1);
             $manager->persist($ac);

             $rp = new Rp;
             $rp ->setNonComplet("Souleyemane Diallo");
             $rp -> setLogin("DialloSoulemane@gmail.com");
             $rp -> setPassword("DER");
            //  $rp ->setEtat(1);
              $manager->persist($rp);

        for ($i = 1; $i < 100; $i++) {
            $etudiant = new Etudiant;
            $etudiant->setNonComplet($faker->name());
            $etudiant->setLogin($faker->email());
            $etudiant->setPassword($faker->password());
            $etudiant->setAdresse($faker->address());
            $etudiant->setSexe($i%2==0 ? "M": "F");
            // $etudiant->setEtat(1);
            $etudiant->setMatricule(strtoupper($faker->word()));
            $manager->persist($etudiant);
        }

        for($i = 1; $i <5 ; $i++){
            $anneeScolaire = new AnneeScolaire();
            $anneeScolaire ->setLibelle("202".$i."-202".($i+1));
            // $anneeScolaire -> setEtat(1);
            // if($i>1){
            //     $anneeScolaire -> setEtat(0);
            // }
            // $manager->persist( $anneeScolaire);
       }

       for ($i=1; $i < 50; $i++) { 
        $classe = new Classe();
        $classe ->setLibelle("classe".$i);
        $classe ->setFilier("pc");
        $classe ->setNiveau("licence".$i);
        // $classe ->setEtat(1);
        $classe ->setRp($rp);
        $manager->persist($classe);
    }

       for ($i=1; $i < 50; $i++) { 
           $inscri = new Inscription();
           $inscri -> setdate($faker->dateTimeBetween("Y-m-d"));
        //    $inscri ->setetat(1);
           $inscri ->setEtudiant($etudiant);
           $inscri->setAc($ac);
           $inscri->setAnneeScolaire($anneeScolaire);
           $inscri->setClasse($classe);
           $manager->persist($inscri);

       }

        $manager->flush();
    }

}
