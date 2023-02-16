<?php

namespace App\Services\Integrator\Connectors\Perfectum;

use App\Data\User\Integrator;
use App\Services\Integrator\BaseClient;

class PerfectumClient extends BaseClient
{

    public function __construct(Integrator $integrator)
    {
        parent::__construct($integrator);

        //TODO: Відправка даних, по ключу, без додаткової авторизації
        $this->setHeaders([
            'x-username' => $integrator->username,
            'x-password' => $integrator->password,
            'x-api' => $integrator->token
        ]);
    }
}
