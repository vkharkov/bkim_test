<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\AuthRequest;
use App\Resources\Api\UserResource;
use App\Services\AuthService;

class AuthController extends ApiController
{

    public function __construct(private AuthService $authService)
    {}

    /**
     * @OA\Post(
     *  path="/user/auth",
     *  summary="User authorization",
     *
     *  @OA\RequestBody(
     *      required=false,
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *      @OA\Schema(
     *          required={},
     *          @OA\Property(
     *              property="email",
     *              description="Email",
     *              type="string",
     *              example="some@mail.com",
     *         ),
     *          @OA\Property(
     *              property="password",
     *              description="Password",
     *              type="string",
     *              example="awesomePass123",
     *         ),
     *          @OA\Property(
     *              property="phone",
     *              description="User phone",
     *              type="string",
     *              example="79100010101",
     *         )
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
    public function __invoke(AuthRequest $request)
    {

        try {

            $response = match (true) {
                $request->has('phone') &&
                $request->has(['email', 'password']) == false => [
                    'token' => null,
                    'code_sent' => $this->authService->sendPhoneCode($request),
                ],
                $request->has('phone') == false &&
                $request->has(['email', 'password']) => [
                    'token' => $this->authService->loginWithEmail($request),
                ]
            };

            return $this->response($response);

        } catch (\Throwable $e) {
            return $this->response(null, e: $e);
        }

    }

}
