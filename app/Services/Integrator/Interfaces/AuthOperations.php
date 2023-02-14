<?php

namespace App\Services\Integrator\Interfaces;

use App\Data\User\User;

interface AuthOperations
{
    public function signUp(User $user): array;
}
