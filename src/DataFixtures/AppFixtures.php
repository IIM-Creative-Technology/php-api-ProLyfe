<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use App\Entity\Etudiant;
use App\Entity\Intervenant;
use App\Entity\Note;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        // $product = new Product();
        // $manager->persist($product);
        
        for($i = 1; $i <= 10; $i++) {
            $classe = new Classe;
            $classe->setNom('Promo 202'.$i);
            $classe->setAnnee('202'.$i);
            $manager->persist($classe);
        }

        for($i = 1; $i <= 10; $i++) {
            $intervenant = new Intervenant;
            $intervenant->setNom($faker->lastName);
            $intervenant->setPrenom($faker->firstNameFemale);
            $intervenant->setAnnee(new DateTime());
            $manager->persist($intervenant);
        }

        $classeKey = $this->classeRepository->findAll();

        for($i = 1; $i <= 20; $i++) {
            $etudiant = new Etudiant;
            $etudiant->setNom($faker->lastName);
            $etudiant->setPrenom($faker->firstNameMale);
            $etudiant->setAge(rand(16, 30));
            $etudiant->setAnnee(2000);
            $etudiant->setPromotion($classeKey[rand(1, 4)]);
            $manager->persist($etudiant);
        }

        // $etudiantKey = $this->etudiantRepository->findAll();

        // for($i = 1; $i <= 10; $i++) {
        //     $note = new Note;
        //     $note->setEtudiant(etudiantKey);
        //     $note->setMatiere($faker->firstNameFemale);
        //     $note->setNote(rand(1, 20));
        //     $manager->persist($note);
        // }
        
        $manager->flush();
    }
}
