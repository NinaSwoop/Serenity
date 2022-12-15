<?php

namespace App\DataFixtures;

use App\Entity\MedicalDiscipline;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MedicalDisciplineFixtures extends Fixture implements DependentFixtureInterface
{
    public const MEDICALDISCIPLINES = [
        ['name' => 'Kinésithérapeute', 'category' => 'Anticiper ma sortie'],
        ['name' => 'Infirmier', 'category' => 'Anticiper ma sortie'],
        ['name' => 'Psychologue', 'category' => 'Anticiper ma sortie'],
        ['name' => 'Ordonnance', 'category' => 'Anticiper ma sortie']
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::MEDICALDISCIPLINES as $values) {
            $medicalDiscipline = new MedicalDiscipline();
            $medicalDiscipline->setName($values['name']);
            $medicalDiscipline->setCategory($this->getReference('category_' . $values['category']));
            $manager->persist($medicalDiscipline);
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
