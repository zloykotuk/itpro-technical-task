<?php

namespace App\Services\Integrator\Connectors\Creatio;

use App\Data\User\Integrator;
use App\Services\Integrator\BaseClient;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;

class CreatioClient extends BaseClient
{
    public function __construct(Integrator $integrator)
    {
        parent::__construct($integrator);

        $this->setHeaders([
            'x-trackbox-username' => $integrator->username,
            'x-trackbox-password' => $integrator->password
        ]);
        $this->auth();
    }

    public function auth(): void
    {
        try {
            $response = $this->client->post('/getKey');

            if (!$response->successful()) {
                $response->throw();
            }

            $this->pushHeaders(['x-api-key' => $response->json('api')]);
        } catch (RequestException $e) {
            Log::error($e->getMessage());
        }
    }

    //TODO: Можна додати до відповіді якщо є запит до цієї CRM
    public function appendResponse(): array
    {
        $response = ['client' => true];
        return array_merge(parent::appendResponse(), $response);
    }
}
