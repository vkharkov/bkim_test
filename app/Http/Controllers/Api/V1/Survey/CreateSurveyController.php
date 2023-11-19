<?php

namespace App\Http\Controllers\Api\V1\Survey;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\SurveyRequest;
use App\Repositories\UserRepository;
use App\Services\ClientService;

/**
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * )
 */
class CreateSurveyController extends ApiController
{

    public function __construct(private ClientService $clientService, private UserRepository $userRepository)
    {}

    /**
     * @OA\Post(
     *  path="/survey/create",
     *  summary="Create client survey",
     *  security={{"bearerAuth":{}}},
     *  @OA\RequestBody(
     *      required=false,
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *      @OA\Schema(
     *          required={},
     *          @OA\Property(
     *               property="first_name",
     *               description="Client first name",
     *               example="John",
     *               type="string"
     *           ),
     *           @OA\Property(
     *               property="middle_name",
     *               description="Client middle name",
     *               example="N",
     *               type="string"
     *           ),
     *           @OA\Property(
     *               property="last_name",
     *               description="Client last name",
     *               example="Smith",
     *               type="string"
     *           ),
     *           @OA\Property(
     *               property="dob",
     *               description="Client date of birth",
     *               example="01.01.1971",
     *               type="date"
     *           ),
     *           @OA\Property(
     *               property="comment",
     *               description="Client comment",
     *               example="I want to buy some properties",
     *               type="string"
     *           )
     *         ),
     *       ),
     *     ),
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *    )
     *  )
     *
     * @throws \Throwable
     */
    public function __invoke(SurveyRequest $request)
    {

        try {

            $this->clientService->setUser($this->userRepository->getAuthorizedUser());
            $survey = $this->clientService->createSurvey($request);
            return $this->response($survey);

        } catch (\Throwable $e) {
            return $this->response(null, e: $e);
        }

    }
}
