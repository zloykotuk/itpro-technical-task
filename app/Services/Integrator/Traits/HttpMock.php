<?php

namespace App\Services\Integrator\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

trait HttpMock
{
    public function fake(): void
    {
        Http::fake([
            'https://www.creatio.com/ua/getKey' => Http::response(['api' => Str::random()]),
            'https://www.creatio.com/ua/sigup' => Http::response(['status' => 'ok', 'message' => 'ok']),
        ]);
    }
}
