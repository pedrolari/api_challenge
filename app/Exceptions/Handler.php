<?php

namespace App\Exceptions;

use App\Validators\Base\Violation;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        NotFoundException::class,
        NotFoundHttpException::class,
        MethodNotAllowedHttpException::class
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


    /**
     * @param $request
     * @param Throwable $exception
     * @return JsonResponse|\Illuminate\Http\Response|Response
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundException) {
            return response()->json(['message' => $exception->getValueNotFound()], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json(['message' => $exception->getMessage() ?: 'Not Found'], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof ConflictHttpException) {
            return response()->json(['message' => $exception->getMessage() ?: 'exists'], Response::HTTP_CONFLICT);
        }

        if ($exception instanceof ValidationErrorException) {
            /** @var Violation[] $violations */
            $violations = $exception->getViolations();

            $response = ['message' => 'Validation Error', 'violations' => []];

            foreach ($violations as $violation) {
                $response['violations'][] = [
                    'message' => $violation->getMessage(),
                    'path' => $violation->getPath(),
                    'code' => $violation->getCode()
                ];
            }

            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        if ($exception instanceof BadRequestHttpException) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        if ($exception instanceof UnexpectedException && !config('app.debug')) {
            $this->sendEmail($exception);
            return response()->json(['message' => 'Internal Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            throw new NotFoundHttpException();
        }

        if ($exception instanceof ValidationException) {
            $response = ['message' => 'Validation Error', 'violations' => []];
            foreach ($exception->errors() as $key => $errorMessages) {
                $message = '';
                foreach ($errorMessages as $errorMessage) {
                    $message .= "$errorMessage ";
                }

                $response['violations'][] = [
                    'message' => trim($message),
                    'path' => $key,
                    'code' => 0
                ];
            }

            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        if (($exception instanceof \Exception || $exception instanceof \Error) && !config('app.debug')) {
            return response()->json(['message' => 'Internal Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return parent::render($request, $exception);
    }
}
