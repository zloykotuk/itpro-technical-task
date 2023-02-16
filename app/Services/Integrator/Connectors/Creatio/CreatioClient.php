<?php

namespace App\Services\Integrator\Connectors\Creatio;

use App\Data\User\Integrator;
use App\Models\Integration;
use App\Services\Integrator\BaseClient;
use App\Services\Integrator\Interfaces\ClientWithAuth;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;

class CreatioClient extends BaseClient implements ClientWithAuth
{
    public function __construct(Integrator $integrator)
    {
        parent::__construct($integrator);

        $this->setHeaders([
            'x-trackbox-username' => $integrator->username,
            'x-trackbox-password' => $integrator->password
        ]);

        //TODO: Отримання токену, проте щоб не було великої кількості запитів перевіряємо термін дії ключа
        if (!$integrator->token || !$integrator->token_expires_in || Date::now()->gt($integrator->token_expires_in)) {
            $this->auth();
        }

        $this->setApiKey($this->integrator->token);
    }

    public function auth(): void
    {
        try {
            $response = $this->client->post('/getKey');

            if (!$response->successful()) {
                $response->throw();
            }

            $this->integrator->token = $response->json('api');
            $this->integrator->token_expires_in =  Date::now()->addDay();

            $this->refreshApiKeyInModel();
        } catch (RequestException $e) {
            Log::error($e->getMessage());
        }
    }

    private function refreshApiKeyInModel()
    {
        Integration::query()->where('id', $this->integrator->id)->update([
            'token' => $this->integrator->token,
            'token_expires_in' => $this->integrator->token_expires_in
        ]);
    }

    private function setApiKey(string $token)
    {
        $this->pushHeaders(['x-api-key' => $token]);
    }

    //TODO: Можна додати до відповіді якщо є запит до цієї CRM
    public function appendResponse(): array
    {
        $response = ['client' => true];
        return array_merge(parent::appendResponse(), $response);
    }

    //TODO: Можна додати логіку до запиту, якщо є запит до цієї CRM
    public function prepareData(array $data): array
    {
        $request = ['clientPrepare' => true];
        return array_merge(parent::prepareData($data), $request);
    }
}
