<?php

namespace App\Http\Controllers;

use App\Data\User\Integrator;
use App\Events\IntegratorRequestReceived;
use App\Exceptions\IntegratorDataException;
use Illuminate\Http\Request;

class IntegratorController extends Controller
{
    public function __construct(Request $request)
    {
        try {
            $integrator = Integrator::fromID($request);
            event(new IntegratorRequestReceived($request->method(), $request->path(), $request->toArray(), $integrator));
        } catch (IntegratorDataException) {
            $integratorId = $request->get('integrator_id');

            if (!is_numeric($integratorId)) {
                $integratorId = null;
            }

            event(new IntegratorRequestReceived($request->method(), $request->path(), $request->toArray(), $integratorId));
        }
    }
}
