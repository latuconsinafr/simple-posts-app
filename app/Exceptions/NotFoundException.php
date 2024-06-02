<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundException extends NotFoundHttpException
{
    /**
     * NotFoundException constructor.
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
            'status'    => 404,
            'timestamp' => now()->toDateTimeString(),
            'path'      => request()->path(),
            'success'   => false,
            'message'   => 'Resource not found'
        ], 404);
    }
}
