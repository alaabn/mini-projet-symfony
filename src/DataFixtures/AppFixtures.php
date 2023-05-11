<?php

namespace App\DataFixtures;

use App\Entity\Plat;
use App\Entity\Regime;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasherInterface;
    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface) 
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        // Test UserData
        $user = new User();
        $user->setName('test');
        $user->setEmail('test@mail.com');
        $user->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $user,
                'password'
            )
        );
        $user->setRoles(["ROLE_USER"]);

        $manager->persist($user);


        // Test PlatData
        $plat = new Plat();
        $plat->setNomPlat('platTest');
        $plat->setNbrCalories(50);
        $plat->setIngredients('ingredientsTest');
        $plat->setCout(32.3);
        $plat->setUser($user);

        $plat1 = new Plat();
        $plat1->setNomPlat('platTest1');
        $plat1->setNbrCalories(50);
        $plat1->setIngredients('ingredientsTest1');
        $plat1->setCout(32.3);
        $plat1->setUser($user);

        $plat2 = new Plat();
        $plat2->setNomPlat('platTest2');
        $plat2->setNbrCalories(50);
        $plat2->setIngredients('ingredientsTest2');
        $plat2->setCout(32.3);
        $plat2->setUser($user);

        $manager->persist($plat);
        $manager->persist($plat1);
        $manager->persist($plat2);


        // Test RegimeData
        $regime = new Regime;
        $regime->setNomRegime('regimeTest');
        $regime->setDuree(50);
        $regime->setType('typeTest');
        $regime->setImage('https://resize.elle.fr/original/var/plain_site/storage/images/elle-a-table/les-dossiers-de-la-redaction/dossier-de-la-redac/plat-familial-sans-four/97674745-2-fre-FR/15-recettes-de-plats-familiaux-sans-four.jpg');
        $regime->addPlat($plat);
        $regime->setUser($user);

        $regime1 = new Regime;
        $regime1->setNomRegime('regimeTest1');
        $regime1->setDuree(50);
        $regime1->setType('typeTest1');
        $regime1->setImage('https://resize.elle.fr/original/var/plain_site/storage/images/elle-a-table/les-dossiers-de-la-redaction/dossier-de-la-redac/plat-familial-sans-four/97674745-2-fre-FR/15-recettes-de-plats-familiaux-sans-four.jpg');
        $regime1->addPlat($plat1);
        $regime1->addPlat($plat2);
        $regime1->setUser($user);

        $manager->persist($regime);
        $manager->persist($regime1);

        $manager->flush();
    }
}
