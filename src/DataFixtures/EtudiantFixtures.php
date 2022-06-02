<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Etudiant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();
        for ($i = 1; $i < 100; $i++) {
            $etudiant = new Etudiant;
            $etudiant->setNonComplet($faker->name());
            $etudiant->setLogin($faker->email());
            $etudiant->setPassword($faker->password());
            $etudiant->setAdresse($faker->address());
            $etudiant->setSexe($i%2==0 ? "M": "F");
            $etudiant->setEtat(1); 
            $etudiant->setMatricule(strtoupper($faker->word()));

            
            $manager->persist($etudiant);
        }

        $manager->flush();
    }
}
