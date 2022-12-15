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
            'category' => 'Comprendre mon opération'
        ],
        [
            'picture' => 'Schema2.jpg',
            'category' => 'Comprendre mon opération'
        ],
        [
            'picture' => 'Schema3.jpg',
            'category' => 'Comprendre mon opération'
        ],
        [
            'picture' => 'Schema4.jpg',
            'category' => 'Comprendre mon opération'
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SCHEMACONTENT as $values) {
            $schemaContent = new SchemaContent();
            $schemaContent->setPicture($values['picture']);
            $schemaContent->setCategory($this->getReference('category_' . $values['category']));
            $manager->persist($schemaContent);
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
