<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class HealthCheckController extends Controller
{
    public function __invoke()
    {
        return response()->json(['status' => 'ok'], Response::HTTP_OK);
    }
}
