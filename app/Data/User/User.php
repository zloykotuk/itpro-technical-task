<?php

namespace App\Data\User;

use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Confirmed;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Password;
use Spatie\LaravelData\Data;
use Symfony\Contracts\Service\Attribute\Required;

class User extends Data
{
    public function __construct(
        #[Max(50), MapName('first_name')]
        public string $firstName,
        #[Max(50),  MapName('last_name')]
        public string $lastName,
        #[Email]
        public string $email,
        #[Required, Password(6), Confirmed]
        public string $password,
        #[Required, MapName('password_confirmation')]
        public string $passwordConfirmation,
    ) {
    }
}
