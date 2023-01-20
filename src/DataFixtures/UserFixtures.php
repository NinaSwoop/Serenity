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
            'email' => 'jeanmichel@gmail.com',
            'role' => ['ROLE_USER'],
            'password' => 'jeanmichel',
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
        [
            'firstname' => 'Thomas',
            'lastname' => 'Aldaitz',
            'phonenumber' => '0637489135',
            'email' => 'toto@gmail.com',
            'role' => ['ROLE_ADMIN'],
            'password' => 'toto123',
            'picture' => 'thomas-aldaitz.jpg',
            'secretariat' => 'secretariat_neurologie',
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
            $hash = $this->passwordHasher->hashPassword($user, $values['password']);
            $user->setPassword($hash);
            $manager->persist($user);
            $key++;
            $this->addReference('user_' . $key, $user);
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
