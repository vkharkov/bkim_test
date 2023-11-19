<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Api\ApiController;
use App\Repositories\UserRepository;
use App\Resources\Api\UserResource;
use Illuminate\Http\JsonResponse;

class UserController extends ApiController
{

    public function __construct(private readonly UserRepository $userRepository) {}

    public function profile(): JsonResponse
    {
        return $this->response(new UserResource($this->userRepository->getAuthorizedUser()));
    }

}
