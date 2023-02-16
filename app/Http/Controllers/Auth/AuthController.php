<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\SignUpAction;
use App\Data\User\Integrator;
use App\Data\User\User;
use App\Http\Controllers\IntegratorController;
use Illuminate\Http\Request;

class AuthController extends IntegratorController
{
    public function signUp(User $user, Request $request)
    {
        $integrator = Integrator::fromID($request);
        return app(SignUpAction::class)($user, $integrator);
    }
}
