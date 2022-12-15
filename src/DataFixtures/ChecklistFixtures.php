<?php

namespace App\DataFixtures;

use App\Entity\Checklist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ChecklistFixtures extends Fixture implements DependentFixtureInterface
{
    public const CHECKLISTS = [
        [
            'name' => 'Pièce d\'identité',
            'description' => "Obligatoire",
            'category' => 'Ma check-list avant le départ à la clinique',
        ],
        [
            'name' => 'Consultation anesthésique',
            'description' => "Obligatoire",
            'category' => 'Ma check-list avant le départ à la clinique'
        ],
        [
            'name' => 'Test COVID',
            'description' => "Datant de moins de 3 jours",
            'category' => 'Ma check-list avant le départ à la clinique'
        ],
        [
            'name' => 'Carte bleue',
            'description' => "Facultatif",
            'category' => 'Ma check-list avant le départ à la clinique'
        ],
        [
            'name' => 'Get influenza vaccine each fall',
            'description' => "Getting Vaccinated",
            'category' => 'Ma check-list avant le départ à la clinique'
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CHECKLISTS as $values) {
            $checklist = new Checklist();
            $checklist->setName($values['name']);
            $checklist->setDescription($values['description']);
            $checklist->setCategory($this->getReference('category_' . $values['category']));
            $manager->persist($checklist);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
