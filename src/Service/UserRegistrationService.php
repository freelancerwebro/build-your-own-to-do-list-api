<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\RegisterUserDTO;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class UserRegistrationService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function register(RegisterUserDTO $dto): User
    {
        $user = new User();
        $user->setEmail($dto->email);
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, $dto->password)
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}
