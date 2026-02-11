<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof UnauthorizedException)
            $exception = new NotFoundHttpException();

        if ($request->expectsJson()) {
            if ($exception instanceof NotFoundHttpException || $exception instanceof MethodNotAllowedHttpException)  {
                return response()->json([ 'message' => 'Endpoint tidak ditemukan.'], 404);
            } else if ($exception instanceof AuthenticationException) {
                return response()->json([ 'message' => 'Token tidak valid.'], 401);
            } else if ($exception instanceof AuthorizationException) {
                return response()->json([ 'message' => $exception->getMessage()], 403);
            } else if ($exception instanceof ValidationException) {
                $errors = [];
                foreach ($exception->errors() as $field => $message) {
                    $errors[$field] = $message[0];
                }
                return response()->json([ 'message' => 'Data yang dimasukkan tidak valid.', 'data' => $errors], 422);
            } else if ($exception instanceof ModelNotFoundException) {
                return response()->json([ 'message' => 'Data tidak ditemukan.'], 404);
            } else if ($exception instanceof CustomException) {
                return response()->json(['message' => $exception->getMessage()], $exception->getCode());
            }
        }

        return parent::render($request, $exception);
    }
}
