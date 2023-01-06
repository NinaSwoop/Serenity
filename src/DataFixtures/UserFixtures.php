<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public const USERS = [
        [
            'firstname' => 'Jean-Michel',
            'lastname' => 'Admin',
            'phonenumber' => '0620202020',
            'email' => 'jeanmicheladmin@gmail.com',
            'role' => ['ROLE_ADMIN'],
            'password' => 'jeanmicheladmin',
            'picture' => 'adminpicture.jpg',
            'secretariat' => 'secretariat_neurologie',

        ],
        [
            'firstname' => 'Ibrahim',
            'lastname' => 'User',
            'phonenumber' => '0636656565',
            'email' => 'ibrabra@gmail.com',
            'role' => ['ROLE_USER'],
            'password' => 'ibrabra1234+',
            'picture' => 'ibrabrapicture.jpeg',
            'secretariat' => 'secretariat_orthopédie',
        ],
        [
            'firstname' => 'Nina',
            'lastname' => 'Iacoponelli',
            'phonenumber' => '0612131415',
            'email' => 'nina@gmail.com',
            'role' => ['ROLE_USER'],
            'password' => 'nina1234+',
            'picture' => 'ninapicture.jpeg',
            'secretariat' => 'secretariat_maternité',
        ],
    ];

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::USERS as $key => $values) {
            $user = new User();
            $user->setEmail($values['email']);
            $user->setRoles($values['role']);
            $user->setFirstname($values['firstname']);
            $user->setLastname($values['lastname']);
            $user->setPhonenumber($values['phonenumber']);
            $user->setPicture($values['picture']);
            $user->setSecretariat($this->getReference($values['secretariat']));
            $this->addReference('user_' . $key, $user);
            $hash = $this->passwordHasher->hashPassword($user, $values['password']);
            $user->setPassword($hash);
            $manager->persist($user);
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
