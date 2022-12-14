<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoyFixture extends Fixture
{
    const CATEGORIES = [
        'Comprendre mon opération',
        'Finir les démarches administratives',
        'Préparer mon arrivée en toute sérénité',
        'Anticiper ma sortie',
        'Ma check-list avant le départ à la clinique'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORIES as $categoryName) {
            $category = new Category();
            $category->setTitle($categoryName);
            $manager->persist($category);
            $this->addReference('category_' . $categoryName, $category);
        }
        $manager->flush();
    }
}
