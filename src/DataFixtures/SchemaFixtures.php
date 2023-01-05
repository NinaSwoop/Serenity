<?php

namespace App\DataFixtures;

use App\Entity\SchemaContent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SchemaFixtures extends Fixture implements DependentFixtureInterface
{
    public const SCHEMACONTENT = [
        [
            'picture' => 'Schema1.jpg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_orthopédie', 'secretariat_maternité', 'secretariat_neurologie']
        ],
        [
            'picture' => 'Schema2.jpg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_orthopédie', 'secretariat_maternité', 'secretariat_neurologie']
        ],
        [
            'picture' => 'Schema3.jpg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_orthopédie', 'secretariat_maternité', 'secretariat_neurologie']
        ],
        [
            'picture' => 'Schema4.jpg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_orthopédie', 'secretariat_maternité', 'secretariat_neurologie']
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SCHEMACONTENT as $values) {
            $schemaContent = new SchemaContent();
            $schemaContent->setPicture($values['picture']);
            $schemaContent->setTitle($values['picture']);
            $schemaContent->setCategory($this->getReference('category_' . $values['category']));
            foreach ($values['secretariat'] as $secretariat) {
                $schemaContent->addSecretariat($this->getReference($secretariat));
            }
            $manager->persist($schemaContent);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SecretariatFixtures::class,
        ];
    }
}
