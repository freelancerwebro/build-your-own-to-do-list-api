<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterUserDTO
{
    #[Assert\NotBlank(message: 'Email is required.')]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank(message: 'Password is required.')]
    #[Assert\Length(
        min: 8,
        max: 255,
        minMessage: 'Password must be at least {{ limit }} characters long.',
        maxMessage: 'Password cannot be longer than {{ limit }} characters.'
    )]
    #[Assert\Regex(
        pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/',
        message: 'Password must contain at least one uppercase, one lowercase, one number, and one special character.'
    )]
    public string $password;
}
