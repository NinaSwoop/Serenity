<?php

namespace App\DataFixtures;

use App\Entity\Welfare;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class WelfareFixtures extends Fixture implements DependentFixtureInterface
{
    public const WELFARES = [
        [
            '2023-01-01',
            '2023-01-02',
            '2023-01-03',
            '2023-01-04',
            '2023-01-05',
            '2023-01-06',
            '2023-01-07',
            '2023-01-08',
            '2023-01-09',
            '2023-01-10',
        ],
        [
            '2023-01-05',
            '2023-01-08',
            '2023-01-09',
            '2023-01-11',
            '2023-01-12',
            '2023-01-13',
            '2023-01-15',
            '2023-01-16',
            '2023-01-19',
            '2023-01-20',
        ],
        [
            '2022-01-21',
            '2022-01-22',
            '2022-01-23',
            '2022-01-26',
            '2022-01-27',
            '2022-01-30',
            '2023-01-02',
            '2023-01-03',
            '2023-01-05',
            '2023-01-06',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 10; $j++) {
                $welfare = new Welfare();
                $welfare->setScore($faker->numberBetween(1, 3));
                $welfare->setResponseAt(\DateTimeImmutable::createFromFormat('Y-m-d', self::WELFARES[$i][$j]));
                $userNb = $i + 1;
                $welfare->addUser($this->getReference('user_' . $userNb));
                $manager->persist($welfare);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
