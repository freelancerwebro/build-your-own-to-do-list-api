<?php

declare(strict_types=1);

namespace App\DTO;

use App\Validator\UniqueEmail;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUserDTO
{
    #[Assert\NotBlank(message: 'Email is required.')]
    #[Assert\Email]
    #[UniqueEmail]
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

    #[Assert\NotBlank(message: 'Name is required.')]
    public string $name;

    #[Assert\NotBlank(message: 'AccountType is required.')]
    #[Assert\Choice(choices: ['freelancer', 'company'], message: 'Choose a valid account type (freelancer, company).')]
    public string $accountType;

    #[Assert\NotBlank(message: 'Country is required.')]
    public string $country;
}
