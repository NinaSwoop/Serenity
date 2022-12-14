<?php

namespace App\DataFixtures;

use App\Entity\Checklist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ChecklistFixtures extends Fixture
{
    public const CHECKLIST = [
        ['name' => 'Pièce d\'identité', 'description' => "Obligatoire",],
        ['name' => 'Consultation anesthésique', 'description' => "Obligatoire",],
        ['name' => 'Test COVID', 'description' => "Datant de moins de 3 jours",],
        ['name' => 'Carte bleue', 'description' => "Facultatif",],
        ['name' => 'Get influenza vaccine each fall', 'description' => "Getting Vaccinated",]
    ];

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
