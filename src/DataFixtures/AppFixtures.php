<?php

namespace App\DataFixtures;

use App\Entity\Blogpost;
use App\Entity\Categorie;
use App\Entity\Peinture;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    private $hasher;
    private $slugger;

    public function __construct(UserPasswordHasherInterface $hasher, SluggerInterface $slugger)
    {
        $this->hasher = $hasher;
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // 🔹 Création d'un utilisateur de test
        $user = new User();
        $user->setEmail('user@example.com');
        $user->setPrenom($faker->firstName());
        $user->setNom($faker->lastName());
        $user->setTelephone($faker->phoneNumber());
        $user->setAPropos($faker->text());
        $user->setInstagram($faker->userName());
        $user->setRoles(['ROLE_PEINTRE']);

        $password = $this->hasher->hashPassword($user, 'password');
        $user->setPassword($password);

        $manager->persist($user);

        // 🔹 Génération de 10 Blogposts
        for ($i = 0; $i < 10; $i++) {
            $blogpost = new Blogpost();
            $titre = $faker->sentence(3);
            $blogpost->setTitre($titre);
            $blogpost->setCreatedAt($faker->dateTimeBetween('-1 years', 'now'));
            $blogpost->setContenu($faker->text(350));
            $blogpost->setSlug($this->slugger->slug($titre)->lower());
            $blogpost->setUser($user);

            $manager->persist($blogpost);
        }

        // 🔹 Génération de 5 catégories
        $categories = [];
        for ($i = 0; $i < 5; $i++) {
            $categorie = new Categorie();

            $categorie->setNom($faker->word);
            $categorie->setDescription($faker->sentence(10));
            $categorie->setSlug($faker->slug());

            $manager->persist($categorie);


            for ($i = 0; $i < 10; $i++) {
                $peinture = new Peinture();
                $peinture->setNom($faker->words(3, true));
                $peinture->setLargeur($faker->randomFloat(2, 30, 200)); // Largeur entre 30 et 200 cm
                $peinture->setHauteur($faker->randomFloat(2, 30, 200)); // Hauteur entre 30 et 200 cm
                $peinture->setEnVente($faker->boolean());
                $peinture->setDateRealisation($faker->dateTimeBetween('-2 years', 'now'));
                $peinture->setCreatedAt(new \DateTimeImmutable());
                $peinture->setDescription($faker->text());
                $peinture->setPortfolio($faker->boolean());
                $peinture->setSlug($faker->slug());
                $peinture->setFile('/img/pic.jpg');
                $peinture->addCategorie($categorie);
                $peinture->setPrix($faker->randomFloat(2, 50, 1000));
                $peinture->setUser($user);


                $manager->persist($peinture);
            }

            $manager->flush();
        }
    }
}