<?php

namespace App\DataFixtures;

use App\Entity\Rp;
use App\Entity\Classe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClasseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $rp = new Rp;
        $rp ->setNonComplet("Souleyemane Diallo");
        $rp -> setLogin("DialloSoulemane@gmail.com");
        $rp -> setPassword("DER");
        $rp ->setEtat(1);
        $manager->persist($rp);
        for ($i=1; $i < 50; $i++) { 
            $classe = new Classe();
            $classe ->setLibelle("classe".$i);
            $classe ->setFilier("pc");
            $classe ->setNiveau("licence".$i);
            $classe ->setEtat(1);
            $classe ->setRp($rp);
            $manager->persist($classe);
        }
        $manager->flush();

    }
}
