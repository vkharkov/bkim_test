<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * @OA\OpenApi(
 *  @OA\Info(
 *      title="Super puper API",
 *      version="1.0.0",
 *      description="API documentation for Super puper API",
 *      @OA\Contact(
 *          email="iam@vkharkov.ru"
 *      )
 *  ),
 *  @OA\Server(
 *      description="Returns App API",
 *      url="http://localhost:8100/api/v1"
 *  ),
 *  @OA\PathItem(
 *      path="/"
 *  )
 * )
 */
class ApiController extends Controller
{

    protected function response($data, $statusCode = 200, \Throwable $e = null): JsonResponse
    {

        return response()->json([
            /** Show that response has errors */
            'error' => match ($statusCode < 400 && $e === null){
                true => false,
                false => true
            },
            'data' => $data,
            'exception' => match ($e === null){
                true => null,
                default => [
                    'class' => get_class($e),
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            }

        ], $statusCode);

    }

}
