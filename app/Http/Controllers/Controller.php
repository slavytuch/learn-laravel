<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function success($data, $statusCode = 200): Response
    {
        return response(['data' => $data, 'status' => 'success'], $statusCode);
    }

    protected function error($message, $errorCode = 500): Response
    {
        return response(['message' => $message], $errorCode);
    }
}
