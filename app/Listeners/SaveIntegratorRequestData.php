<?php

namespace App\Listeners;

use App\Events\IntegratorRequestReceived;
use App\Models\IntegratorRequestHistory;
use Spatie\LaravelData\Contracts\DataObject;

class SaveIntegratorRequestData
{
    public function handle(IntegratorRequestReceived $event): void
    {
        IntegratorRequestHistory::query()->create([
           'method' => $event->method,
           'path' => $event->path,
           'data' => json_encode($event->data),
           'integrator_id' => $event->integrator instanceof DataObject ? $event->integrator->id : $event->integrator
        ]);
    }
}
