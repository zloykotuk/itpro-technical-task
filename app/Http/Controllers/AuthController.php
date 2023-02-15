<?php

namespace App\Http\Controllers;

use App\Actions\Auth\SignUpAction;
use App\Data\User\Integrator;
use App\Data\User\User;
use Illuminate\Http\Request;

class AuthController extends IntegratorController
{
    public function signUp(User $user, Request $request)
    {
        $integrator = Integrator::fromID($request);
        return app(SignUpAction::class)($user, $integrator);
    }
}
