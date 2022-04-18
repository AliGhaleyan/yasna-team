<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidationException)
            return $this->makeErrorResponse($e->status, $e->errors());

        if ($e instanceof HttpException) {
            $userMessage = $e->getMessage();
            $statusCode = $e->getStatusCode();

            if ($statusCode == 403) $userMessage = "Forbidden";
            if ($statusCode == 401) $userMessage = "Unauthorized";
            if ($statusCode == 404) $userMessage = "Not Found";

            return $this->makeErrorResponse($e->getStatusCode(), $userMessage);
        }
        return parent::render($request, $e);
    }

    public function makeErrorResponse(int $code, $userMessage = null, $developerMessage = null)
    {
        return new JsonResponse([
            "status"    => 400,
            "errorCode" => $code,
            "userMessage"   => $userMessage,
            "developerMessage"   => $developerMessage,
        ]);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
