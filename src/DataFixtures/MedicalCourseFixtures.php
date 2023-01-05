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
            'title' => 'Prise en charge administrative',
            'picture' => 'MedicalCourse1.png',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_maternité', 'secretariat_neurologie', 'secretariat_orthopédie']
        ],
        [
            'step' => 2,
            'title' => 'Installation en chambre',
            'picture' => 'MedicalCourse-maternite1.jpg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'step' => 3,
            'title' => 'Phase de travail',
            'picture' => 'MedicalCourse-maternite3.jpg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'step' => 4,
            'title' => 'Pose de la péridurale',
            'picture' => 'MedicalCourse-maternite2.jpeg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'step' => 5,
            'title' => 'Accouchement',
            'picture' => 'MedicalCourse-maternite4.jpg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'step' => 6,
            'title' => 'Retour en chambre',
            'picture' => 'MedicalCourse2.jpeg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_maternité', 'secretariat_neurologie', 'secretariat_orthopédie']
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
