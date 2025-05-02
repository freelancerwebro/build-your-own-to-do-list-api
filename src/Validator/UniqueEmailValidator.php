<?php

declare(strict_types=1);

namespace App\Validator;

use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueEmailValidator extends ConstraintValidator
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof UniqueEmail) {
            throw new UnexpectedTypeException($constraint, UniqueEmail::class);
        }

        if (!$value) {
            return;
        }

        $existingUser = $this->userRepository->findOneBy(['email' => $value]);

        if ($existingUser) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
