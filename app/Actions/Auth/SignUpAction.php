<?php

namespace App\Actions\Auth;

use App\Actions\Action;
use App\Data\User\Integrator;
use App\Data\User\User;
use Illuminate\Support\Facades\Log;

class SignUpAction extends Action
{
    public function __invoke(User $user, Integrator $integrator)
    {
        try {
            $authClassName = '\App\Services\Integrator\\Connectors\\' . $integrator->name . '\\' .$integrator->name. 'AuthClient';
            $authClient = new $authClassName($integrator);
            return $authClient->signUp($user);
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
            throw new \LogicException('Internal server error');
        }
    }
}
