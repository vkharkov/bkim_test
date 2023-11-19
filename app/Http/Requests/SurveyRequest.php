<?php

namespace App\Http\Requests;

/**
 * @OA\Schema(
 *     schema="SurveyRequest",
 *     title="SurveyRequest",
 *     description="Create user survey",
 *     @OA\Xml(
 *         name="SurveyRequest"
 *     )
 * )
 */
class SurveyRequest extends ApiRequest
{

    /**
     * @return array<string, mixed>
     *
     * @OA\Property(
     *      property="first_name",
     *      description="Client first name",
     *      example="John",
     *      type="string"
     * ),
     * @OA\Property(
     *      property="middle_name",
     *      description="Client middle name",
     *      example="N",
     *      type="string"
     * ),
     * @OA\Property(
     *      property="last_name",
     *      description="Client last name",
     *      example="Smith",
     *      type="string"
     * ),
     * @OA\Property(
     *      property="dob",
     *      description="Client date of birth",
     *      example="01.01.1971",
     *      type="date"
     * ),
     * @OA\Property(
     *      property="comment",
     *      description="Client comment",
     *      example="I want to buy some properties",
     *      type="string"
     * )
     */
    public function rules()
    {

        return [
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',

            'dob' => 'required|date',
            'comment' => 'nullable|string'
        ];

    }

    public function messages()
    {
        return [
            '*' => 'Некорректные данные',
        ];
    }


}
