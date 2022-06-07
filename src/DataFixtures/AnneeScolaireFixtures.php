<?php

namespace App\DataFixtures;

use App\Entity\AnneeScolaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AnneeScolaireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
    //     for($i = 1; $i <5 ; $i++){
    //          $anneeScolaire = new AnneeScolaire();
    //          $anneeScolaire ->setLibelle("202".$i."-202".($i+1));
    //          $anneeScolaire -> setEtat(1);
    //          if($i>1){
    //              $anneeScolaire -> setEtat(0);
    //          }
    //     $manager->persist( $anneeScolaire);
    //     }

    //     $manager->flush();
    // }
}
}