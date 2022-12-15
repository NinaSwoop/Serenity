<?php

namespace App\DataFixtures;

use App\Entity\Document;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DocumentFixtures extends Fixture implements DependentFixtureInterface
{
    public const DOCUMENTS = [
        [
            'title' => 'Fiche administrative',
            'picture' => 'Document1.jpg',
            'read_time' => 15,
            'description' => '',
            'category' => 'Finir les démarches administratives'
        ],
        [
            'title' => 'Consentement éclairé',
            'picture' => 'Document2.jpg',
            'read_time' => 15,
            'description' => '',
            'category' => 'Finir les démarches administratives'
        ],
        [
            'title' => 'Votre retour mutuelle',
            'picture' => 'Document3.jpg',
            'read_time' => 15,
            'description' => '',
            'category' => 'Finir les démarches administratives'
        ],
        [
            'title' => 'Avez-vous vu votre anesthésiste ?',
            'picture' => 'Document4.jpg',
            'read_time' =>  0,
            'description' => 'Prendre rendez-vous',
            'category' => 'Finir les démarches administratives'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DOCUMENTS as $values) {
            $document = new Document();
            $document->setTitle($values['title']);
            $document->setPicture($values['picture']);
            $document->setReadTime($values['read_time']);
            $document->setDescription($values['description']);
            $document->setCategory($this->getReference('category_' . $values['category']));
            $manager->persist($document);
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
