<?php

namespace App\DataFixtures;

use App\Entity\MedicalCourse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MedicalCourseFixtures extends Fixture implements DependentFixtureInterface
{
    public const MEDICALCOURSES = [
        [
            'step' => 1,
            'title' => 'La douche bétadinée',
            'picture' => 'MedicalCourse1.png',
            'category' => 'Préparer mon arrivée en toute sérénité'
        ],
        [
            'step' => 2,
            'title' => 'Votre dossier administratif',
            'picture' => 'MedicalCourse2.jpg',
            'category' => 'Préparer mon arrivée en toute sérénité'
        ],
        [
            'step' => 3,
            'title' => 'La douche non bétadinée',
            'picture' => 'MedicalCourse3.jpg',
            'category' => 'Préparer mon arrivée en toute sérénité'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::MEDICALCOURSES as $values) {
            $medicalCourse = new MedicalCourse();
            $medicalCourse->setStep($values['step']);
            $medicalCourse->setTitle($values['title']);
            $medicalCourse->setPicture($values['picture']);
            $medicalCourse->setCategory($this->getReference('category_' . $values['category']));
            $manager->persist($medicalCourse);
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
