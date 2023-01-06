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
            'picture' => 'Schema-mater1.jpeg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'picture' => 'Schema-mater2.jpeg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'picture' => 'Schema-mater3.jpeg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'picture' => 'Schema-mater4.jpeg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'picture' => 'Schema-mater5.jpeg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'picture' => 'Schema-ortho1.jpeg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'picture' => 'Schema-ortho2.jpeg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'picture' => 'Schema-ortho3.jpeg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'picture' => 'Schema-ortho4.jpg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'picture' => 'Schema-ortho5.jpeg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'picture' => 'Schema-neuro1.jpeg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_neurologie']
        ],
        [
            'picture' => 'Schema-neuro2.jpeg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_neurologie']
        ],
        [
            'picture' => 'Schema-neuro3.jpeg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_neurologie']
        ],
        [
            'picture' => 'Schema-neuro4.jpeg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_neurologie']
        ],
        [
            'picture' => 'Schema-neuro5.jpeg',
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_neurologie']
        ],
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
