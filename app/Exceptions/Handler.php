<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (AuthenticationException $exception, Request $request) {
            if($request->is('api/*')) {
                if ($exception instanceof AuthenticationException) {
                    return $request->exceptJson() ?:
                    response() -> json([
                        'message' => 'Unauthenticated.',
                        'status' => 401,
                        'Description' => 'Mising or Invalid access token'
                    ], 401);
                }
            }
        });
    }
}
