<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\PhoneAuthRequest;
use App\Services\AuthService;

class PhoneAuthController extends ApiController
{

    public function __construct(private AuthService $authService)
    {}

    /**
     * @OA\Post(
     *  path="/user/auth_by_phone_code",
     *  summary="User authorization",
     *
     *  @OA\RequestBody(
     *      required=false,
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *      @OA\Schema(
     *          required={},
     *          @OA\Property(
     *              property="phone",
     *              description="User phone",
     *              type="string",
     *              example="79100010101",
     *         ),
     *          @OA\Property(
     *              property="code",
     *              description="Password",
     *              type="string",
     *              example="0101",
     *         ),
     *       ),
     *     ),
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *  )
     *
     * @throws \Throwable
     */
    public function __invoke(PhoneAuthRequest $request)
    {

        try {

            $token = $this->authService->loginWithPhone($request);

            return $this->response([ 'token' => $token ]);

        } catch (\Throwable $e) {
            return $this->response(null, e: $e);
        }

    }

}
