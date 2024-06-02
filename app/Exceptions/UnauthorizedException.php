<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;

class UnauthorizedException extends AuthenticationException
{
    /**
     * UnauthorizedException constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        return response()->json([
            'status'    => 401,
            'timestamp' => now()->toDateTimeString(),
            'path'      => request()->path(),
            'success'   => false,
            'message'   => 'Unauthorized'
        ], 401);
    }
}
