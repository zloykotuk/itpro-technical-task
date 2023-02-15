<?php

namespace App\Events;

use App\Data\User\Integrator;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IntegratorRequestReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public string $method,
        public string $path,
        public array $data,
        public Integrator|string|int|null $integrator
    ) {
    }
}
