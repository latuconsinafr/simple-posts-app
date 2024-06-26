<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // * 401
        $this->renderable(function (AuthenticationException $exception, $request) {
            if (!$request->wantsJson()) {
                return null;
            }

            throw new UnauthorizedException();
        });

        // * 404
        $this->renderable(function (NotFoundHttpException $exception, $request) {
            if (!$request->wantsJson()) {
                return null;
            }

            throw new NotFoundException();
        });

        // * 422
        $this->renderable(function (ValidationException $exception, $request) {
            if (!$request->wantsJson()) {
                return null;
            }

            throw InputValidationException::withMessages(
                $exception->validator->getMessageBag()->getMessages()
            );
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
