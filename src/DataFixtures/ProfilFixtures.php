<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfilFixtures extends Fixture
{
    
    public function load(ObjectManager $manager)
    {

        $profils = ["ADMIN", "GERANT"] ;

        for ($i=0; $i < count($profils); $i++) { 
            
            $profil = new Profil() ;

            $profil ->setLibelle($profils[$i]);
            $profil ->setArchivage(0);

            $manager->persist($profil);

        }

        $manager->flush();
    }
}