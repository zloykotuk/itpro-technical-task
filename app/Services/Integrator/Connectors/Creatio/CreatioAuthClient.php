<?php

namespace App\Services\Integrator\Connectors\Creatio;

use App\Data\User\User;
use App\Services\Integrator\Interfaces\AuthOperations;
use Illuminate\Support\Facades\Log;

class CreatioAuthClient extends CreatioClient implements AuthOperations
{
    public function signUp(User $user): array
    {
        //TODO: Тут є можливість додати обробку перед данних перед відправкою
        try {
            $response = $this->client->post('/sigup', $user->toArray());

            if ($response->failed()) {
                throw new \HttpRequestException('Failed query');
            }

            //TODO: тут можна добавити у відовідь додаткові поля як стосуються входу
            $appendResponse = ['func' => true];

            return $this->toResponse(array_merge($user->toArray(), $response->json(), $appendResponse));
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());

            return $this->toResponse(array_merge($user->toArray(), ['error' => $exception->getMessage()]));
        }
    }
}
