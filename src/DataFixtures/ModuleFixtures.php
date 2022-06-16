<?php

namespace App\DataFixtures;

use App\Entity\Module;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ModuleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i < 50; $i++) { 
            $mod = new Module();
            // $mod->setEtat(1);
            $mod->setLibelle("mathématique");
            $manager->persist($mod);
        }
     

        $manager->flush();
    }
}
