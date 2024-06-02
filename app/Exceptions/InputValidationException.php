<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;

class InputValidationException extends ValidationException
{
    /**
     * CustomValidationException constructor.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     */
    public function __construct($validator)
    {
        parent::__construct($validator);
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
            'status'    => 422,
            'timestamp' => now()->toDateTimeString(),
            'path'      => request()->path(),
            'success'   => false,
            'message'   => $this->errors()
        ], 422);
    }
}
