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
            'title' => 'Mon chirurgien me parle des croisées',
            'picture' => 'Video1.jpg',
            'duration' => 3,
            'category' => 'Comprendre mon opération'
        ],
        [
            'title' => 'Comment améliorer ma prise en charge',
            'picture' => 'Video2.jpg',
            'duration' => 4,
            'category' => 'Comprendre mon opération'
        ],
        [
            'title' => 'Témoignages de patients',
            'picture' => 'Video3.jpg',
            'duration' => 7,
            'category' => 'Comprendre mon opération'
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
            $manager->persist($video);
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
