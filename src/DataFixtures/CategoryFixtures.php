<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
    private const CATEGORIES = [

        [
            'title' => "Comprendre mon opération",
            'progressColor' => "cat1-progress",
            'progressbarColor' => "cat1-progressbar",

        ],
        [
            'title' => "Finir les démarches administratives",
            'progressColor' => "cat2-progress",
            'progressbarColor' => "cat2-progressbar",

        ],
        [
            'title' => "Préparer mon arrivée en toute sérénité",
            'progressColor' => "cat3-progress",
            'progressbarColor' => "cat3-progressbar",

        ],
        [
            'title' => "Anticiper ma sortie",
            'progressColor' => "cat4-progress",
            'progressbarColor' => "cat4-progressbar",

        ],
        [
            'title' => 'Ma check-list avant le départ à la clinique',
            'progressColor' => 'cat5-progress',
            'progressbarColor' => 'cat5-progressbar',

        ],
    ];


    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORIES as $values) {
            $category = new Category();
            $category->setTitle($values['title']);
            $category->setProgressColor($values['progressColor']);
            $category->setProgressbarColor($values['progressbarColor']);
            $manager->persist($category);
            $this->addReference('category_' . $values['title'], $category);
        }
        $manager->flush();
    }
}
