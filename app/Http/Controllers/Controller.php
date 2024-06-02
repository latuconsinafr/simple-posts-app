<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Send success response method.
     *
     * @param  mixed   $result
     * @param  string  $message
     * @param  int     $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($result, $message, $code = 200)
    {
        $response = [
            'status'    => $code,
            'timestamp' => now()->toDateTimeString(),
            'path'      => request()->path(),
            'success'   => true,
            'message'   => $message,
            'data'      => $result,
        ];

        return response()->json($response, $code);
    }

    /**
     * Return error response.
     *
     * @param  string  $error
     * @param  array   $errorMessages
     * @param  int     $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($error, $errorMessages = [], $code = 500)
    {
        $response = [
            'status'    => $code,
            'timestamp' => now()->toDateTimeString(),
            'path'      => request()->path(),
            'success'   => false,
            'message'   => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
