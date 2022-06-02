<?php

namespace App\DataFixtures;

use App\Entity\Rp;
use Faker\Factory;
use App\Entity\Demande;
use App\Entity\Etudiant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class DemandeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $rp = new Rp;
        $rp ->setNonComplet("Mbaye lo");
        $rp -> setLogin("Mbayelo@gmail.com");
        $rp -> setPassword("DER");
        $rp ->setEtat(1);
        $manager->persist($rp);

        $etud = new Etudiant;
        $etud ->setNonComplet("Mouhamede Mbodji");
        $etud -> setLogin("mbodjimouhamede@gmail.com");
        $etud ->setPassword("DER");
        $etud -> setEtat(1);
        $etud -> setMatricule(1);
        $etud -> setSexe("M");
        $etud -> setAdresse("Gediawaye");

        $manager->persist($etud);

        $fakere = Factory::create();
        for ($i=1; $i <50 ; $i++) { 
            $demad = new Demande(); 
            $demad->setMotif($i%2==0 ? "Anuller" : "Confirmer");
            $demad->setdate($fakere->dateTimeBetween('Y-m-d'));
            $demad->setEtat(1);
            $demad->setRp($rp);
            $demad->setEtudiant($etud);
            $manager->persist($demad);
        }
       

        $manager->flush();
    }
}
