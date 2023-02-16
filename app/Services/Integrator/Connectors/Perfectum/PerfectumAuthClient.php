<?php

namespace App\Services\Integrator\Connectors\Perfectum;

use App\Data\User\User;
use App\Services\Integrator\Interfaces\AuthOperations;
use Illuminate\Support\Facades\Log;

class PerfectumAuthClient extends PerfectumClient implements AuthOperations
{
    public function signUp(User $user): array
    {
        //TODO: Тут є можливість додати обробку перед данних перед відправкою
        $data = $user->toArray();

        try {
            $response = $this->client->post('/api/example/sigup', $this->prepareData($data));

            if ($response->failed()) {
                throw new \HttpRequestException('Failed query');
            }

            return $this->toResponse(array_merge($user->toArray(), $response->json()));
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());

            return $this->toResponse(array_merge($user->toArray(), ['error' => $exception->getMessage()]));
        }
    }
}
