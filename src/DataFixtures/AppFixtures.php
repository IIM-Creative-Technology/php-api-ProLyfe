<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use App\Entity\Etudiant;
use App\Entity\Intervenant;
use App\Entity\Matiere;
use App\Entity\Note;
use App\Entity\User;
use App\Repository\ClasseRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
    */
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $entityManager;
        $this->classeRepository = $this->entityManager->getRepository(Classe::class);
        $this->intervenantRepository = $this->entityManager->getRepository(Intervenant::class);
        $this->etudiantRepository = $this->entityManager->getRepository(Etudiant::class);
        $this->matiereRepository = $this->entityManager->getRepository(Matiere::class);
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        // $product = new Product();
        // $manager->persist($product);
        
        for($i = 1; $i <= 4; $i++) {
            $classe = new Classe;
            $classe->setNom('Promo 202'.$i);
            $classe->setAnnee('202'.$i);
            $manager->persist($classe);
        }
        $manager->flush();

        for($i = 1; $i <= 10; $i++) {
            $intervenant = new Intervenant;
            $intervenant->setNom($faker->lastName);
            $intervenant->setPrenom($faker->firstNameFemale);
            $intervenant->setAnnee(new DateTime());
            $manager->persist($intervenant);
        }
        $manager->flush();

        $classeKey = $this->classeRepository->findAll();
        for($i = 1; $i <= 20; $i++) {
            $etudiant = new Etudiant;
            $etudiant->setNom($faker->lastName);
            $etudiant->setPrenom($faker->firstNameMale);
            $etudiant->setAge(rand(16, 30));
            $etudiant->setAnnee(rand(2018, 2023));
            $etudiant->setPromotion($classeKey[rand(0, 3)]);
            $manager->persist($etudiant);
        }
        $manager->flush();

        $intervenantKey = $this->intervenantRepository->findAll();
        for($i = 0; $i <= 3; $i++) {
            $matiere = new Matiere;
            $matiere->setNom($faker->jobTitle);
            $matiere->setIntervenant($intervenantKey[$i]);
            $matiere->setPromotion($classeKey[$i]);
            $matiere->setDateStart(new DateTime());
            $matiere->setDateEnd($faker->dateTimeInInterval($matiere->getDateStart(), '+ 5 days', null));
            $manager->persist($matiere);
        }
        $manager->flush();


        $etudiantKey = $this->etudiantRepository->findAll();
        $matiereKey = $this->matiereRepository->findAll();
        for($i = 0; $i <= 3; $i++) {
            $note = new Note;
            $note->setEtudiant($etudiantKey[$i]);
            $note->setMatiere($matiereKey[$i]);
            $note->setNote(rand(0, 20));
            $manager->persist($note);
        }
        $manager->flush();


        for($i = 0; $i <= 3; $i++) {
            $user = new User;
            $user->setEmail('iim' . $i . 'admin.devinci.fr');
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'password'));

            $manager->persist($user);
        }
        $manager->flush();

    }
}
