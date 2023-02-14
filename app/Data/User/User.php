<?php

namespace App\Data\User;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Data;
use Symfony\Contracts\Service\Attribute\Required;

class User extends Data
{
    public function __construct(
        #[Max(50)]
        public string $firstName,
        #[Max(50)]
        public string $lastName,
        #[Email]
        public string $email,
        #[Regex('/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/'), Required]
        public string $phone
    ) {
    }
}
