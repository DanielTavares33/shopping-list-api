<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class HealthCheckController extends Controller
{
    public function __invoke()
    {
        return response()->json(['status' => 'ok'], Response::HTTP_OK);
    }
}
