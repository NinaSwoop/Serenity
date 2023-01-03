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
            'title' => 'LIGAMENTOPLASTIE DU LIGAMENT CROISÉ ANTÉRIEUR PAR ARTHROSCOPIE',
            'picture' => 'https://www.youtube.com/embed/QC91hgRi5vY',
            'duration' => 3,
            'category' => 'Comprendre mon opération'
        ],
        [
            'title' => 'PROTHÈSE TOTALE DE GENOU',
            'picture' => 'https://www.youtube.com/embed/Su2-oVbP8qU',
            'duration' => 4,
            'category' => 'Comprendre mon opération'
        ],
        [
            'title' => 'PROTHÈSE TOTALE DE HANCHE PAR VOIE ANTÉRIEURE MINI-INVASIVE',
            'picture' => 'https://www.youtube.com/embed/FKHuLgs5fzA',
            'duration' => 4,
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
