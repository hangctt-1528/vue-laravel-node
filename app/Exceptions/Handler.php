<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthenticationException::class,
        QueryException::class,
        ValidationException::class,
        AuthorizationException::class,
        ModelNotFoundException::class,
        NotFoundHttpException::class,
        ConflictHttpException::class,
        ThrottleRequestsException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        dd($e);
        \Log::info($e);
        if ($request->expectsJson()) {
            if ($e instanceof ThrottleRequestsException) {
                return $this->responseException(__('exceptions.429'), $e->getStatusCode());
            }

            if ($e instanceof ConflictHttpException) {
                return $this->responseException($e->getMessage(), Response::HTTP_CONFLICT);
            }

            if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
                return $this->responseException(__('exceptions.404'), Response::HTTP_NOT_FOUND);
            }

            if ($e instanceof QueryException || $e instanceof HttpException) {
                return $this->responseException(__('exceptions.400'), Response::HTTP_BAD_REQUEST);
            }

            if ($e instanceof ApiException) {
                return $this->responseException($e->getMessage(), $e->getCode());
            }

            if ($e instanceof ValidationException) {
                $errors = $request->ajax() ? $e->validator->errors() : $e->validator->getMessageBag()->all();
                return $this->responseException(
                    $errors,
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            if ($e instanceof AuthorizationException) {
                return $this->responseException($e->getMessage(), Response::HTTP_FORBIDDEN);
            }

            if ($e instanceof AuthenticationException) {
                return $this->responseException(__('exceptions.401'), Response::HTTP_UNAUTHORIZED);
            }

            if ($e instanceof ClientException) {
                $resp = $e->getResponse();
                return $this->responseException(__('auth.failed'), $resp->getStatusCode());
            }

            if ($e instanceof Exception) {
                return $this->responseException($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        return parent::render($request, $e);
    }

    protected function responseException($message, $code)
    {
        return response()->json([
            'code' => $code,
            'data' => null,
            'message' => is_array($message) ? $message : [$message],
        ], $code);
    }
}
