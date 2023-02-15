<?php

namespace App\Data\User;

use App\Exceptions\IntegratorDataException;
use App\Models\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Spatie\LaravelData\Data;

class Integrator extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $host,
        public ?string $token,
        public ?Date $token_expires_in,
        public string $username,
        public string $password,
    ) {
    }

    /**
     * @throws IntegratorDataException
     */
    public static function fromID(Request $request): static
    {
        $id = $request->get('integrator_id');

        if (!$id) {
            throw new IntegratorDataException('integrator_id is required');
        }

        $integration = Integration::query()->find($id);

        if (!$integration) {
            throw new IntegratorDataException('Integration not found');
        }

        return new self(
            $integration->id,
            $integration->name,
            $integration->host,
            $integration->token,
            $integration->token_expires_in,
            $integration->username,
            $integration->password,
        );
    }
}
