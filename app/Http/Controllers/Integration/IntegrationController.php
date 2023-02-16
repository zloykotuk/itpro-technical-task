<?php

namespace App\Http\Controllers\Integration;

use App\Http\Controllers\Controller;
use App\Http\Resources\Integration\IntegrationCollection;
use App\Models\Integration;

class IntegrationController extends Controller
{
    public function index(): IntegrationCollection
    {
        return IntegrationCollection::make(
            Integration::all()
        );
    }
}
