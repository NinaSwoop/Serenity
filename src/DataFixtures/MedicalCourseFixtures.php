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
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'step' => 2,
            'title' => 'Votre dossier administratif',
            'picture' => 'MedicalCourse2.jpg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_maternité', 'secretariat_neurologie', 'secretariat_orthopédie']
        ],
        [
            'step' => 3,
            'title' => 'La douche non bétadinée',
            'picture' => 'MedicalCourse3.jpg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_maternité', 'secretariat_neurologie']
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
            foreach ($values['secretariat'] as $secretariat) {
                $medicalCourse->addSecretariat($this->getReference($secretariat));
            }
            $manager->persist($medicalCourse);
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
