<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Voiture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $voiture1 = new Voiture();
        $voiture1
                ->setNom("Renault Twingo")
                ->setDescription("Description de la Renault Twingo.")
                ->setPlaces(4)
                ->setManuelle(true)
                ->setPrixQuotidien(39.14)
                ->setPrixMensuel(900);
        $manager->persist($voiture1);

        $voiture2 = new Voiture();
        $voiture2
                ->setNom("Renault Clio")
                ->setDescription("Description de la Renault Clio.")
                ->setPlaces(4)
                ->setManuelle(true)
                ->setPrixQuotidien(38.64)
                ->setPrixMensuel(850);
        $manager->persist($voiture2);

        $voiture3 = new Voiture();
        $voiture3
                ->setNom("BMX IX (Electric)")
                ->setDescription("BMW est connu pour ses voitures puissantes et luxueuses - la BMW iX ne fait pas exception. Avec une puissance allant de 326 ch (BMW iX 40) à 523 ch (BMW iX 50) et une autonomie de 408 (BMW iX 40) à 590 kilomètres (BMW iX 50), la BMW iX offre tout ce que l'on peut attendre d'une voiture électrique.")
                ->setPlaces(4)
                ->setManuelle(true)
                ->setPrixQuotidien(42.4)
                ->setPrixMensuel(950);
        $manager->persist($voiture3);

        $voiture4 = new Voiture();
        $voiture4
                ->setNom("Renault Zoé")
                ->setDescription("Description de la Renault Zoé.")
                ->setPlaces(4)
                ->setManuelle(false)
                ->setPrixQuotidien(39.14)
                ->setPrixMensuel(900);
        $manager->persist($voiture4);

        $voiture5 = new Voiture();
        $voiture5
                ->setNom("Citroën Ami")
                ->setDescription("Description de la Citroën Ami.")
                ->setPlaces(2)
                ->setManuelle(false)
                ->setPrixQuotidien(28.59)
                ->setPrixMensuel(799);
        $manager->persist($voiture5);

        $voiture6 = new Voiture();
        $voiture6
                ->setNom("Opel Corsa")
                ->setDescription("Description de l'Opel Corsa.")
                ->setPlaces(5)
                ->setManuelle(true)
                ->setPrixQuotidien(36.38)
                ->setPrixMensuel(820);
        $manager->persist($voiture6);

        $manager->flush();
    }
}
