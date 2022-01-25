<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    
    private $encoder;
    private $manager;

    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager) {
        $this->encoder = $encoder;
        $this->manager = $manager ;
    }

    public function load(ObjectManager $manager) {

        $faker = Factory::create('fr_FR') ;
        $profils = ["ADMIN", "GERANT"] ;

        for ($i=0; $i < count($profils); $i++) { 

            $user = new User() ;
            // $user ->setEmail ($faker->email);
            $password = $this->encoder->encodePassword($user, 'pass_1234') ;
            $user ->setFirstname($faker->name);
            $user ->setLastname($faker->lastName);
            $user ->setPhone(223666);
            $user ->setUsername("username".$i);
            $user ->setAddress($faker->address);
            $user->setArchivage(false) ;
            $user->setPassword($password) ;
            $user->setProfils($this->manager->getRepository(Profil::class)->findOneBy(['libelle'=>$profils[$i]]));

            $manager->persist($user);

        }

        $manager->flush();
    }
}