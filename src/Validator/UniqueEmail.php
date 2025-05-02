<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute] class UniqueEmail extends Constraint
{
    public string $message = 'This email is already used.';
}
