<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VideoFixtures extends Fixture implements DependentFixtureInterface
{
    public const VIDEOS = [
        [
            'title' => "L'ACCOUCHEMENT",
            'picture' => 'https://www.youtube.com/embed/NM2KJA8uSuc',
            'duration' => 3,
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_maternité']

        ],
        [
            'title' => 'PROTHÈSE DU PIED',
            'picture' => 'https://www.youtube.com/embed/Su2-oVbP8qU',
            'duration' => 4,
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'title' => 'LA NEUROCHIRURGIE',
            'picture' => 'https://www.youtube.com/embed/hXFBWXuZIdo',
            'duration' => 4,
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_neurologie']
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::VIDEOS as $values) {
            $video = new Video();
            $video->settitle($values['title']);
            $video->setPicture($values['picture']);
            $video->setDuration($values['duration']);
            $video->setCategory($this->getReference('category_' . $values['category']));
            foreach ($values['secretariat'] as $secretariat) {
                $video->addSecretariat($this->getReference($secretariat));
            }
            $manager->persist($video);
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
