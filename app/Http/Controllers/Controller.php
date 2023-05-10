<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *  title="API Challenge",
 *  version="1.0.0",
 * ),
 * @OA\Tag(
 *  name="challenge",
 *  description="API Endpoints"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected function error_response($message, $errors = null, $error_code = 400): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'errors' => $errors
        ], $error_code);
    }

    protected function success_response($object, $code = 200): JsonResponse
    {
        return response()->json($object, $code);
    }
}
