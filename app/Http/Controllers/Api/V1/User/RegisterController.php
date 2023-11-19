<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\RegisterRequest;
use App\Resources\Api\UserResource;
use App\Services\UserService;

class RegisterController extends ApiController
{

    /**
     * @OA\Get(
     *     path="/api/data.json",
     *     @OA\Response(
     *         response="200",
     *         description="The data"
     *     )
     * )
     */
    public function __construct(private UserService $userService)
    {}

    /**
     * @OA\Post(
     *  path="/user/register",
     *  summary="User registration",
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
    public function __invoke(RegisterRequest $request)
    {

        try {
            $user = match (true) {
                $request->has('phone') &&
                $request->has(['email', 'password']) == false => $this->userService->registerByPhone($request),
                $request->has('phone') == false &&
                $request->has(['email', 'password']) => $this->userService->registerByMail($request),
            };

            return $this->response(new UserResource($user));
        } catch (\Throwable $e) {
            return $this->response(null, e: $e);
        }

    }
}
