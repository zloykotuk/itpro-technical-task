<?php

namespace App\Services\Integrator\Interfaces;

interface ClientWithAuth
{
    public function auth(): void;
}
