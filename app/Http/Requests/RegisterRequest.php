<?php

namespace App\Http\Requests;

/**
 * @OA\Schema(
 *     schema="RegisterRequest",
 *     title="RegisterRequest",
 *     description="User registration request",
 *     @OA\Xml(
 *         name="RegisterRequest"
 *     )
 * )
 */
class RegisterRequest extends ApiRequest
{

    /**
     * @return array<string, mixed>
     *
     * @OA\Property(
     *      property="phone",
     *      description="User phone",
     *      example="79100010101",
     *      type="string"
     * ),
     * @OA\Property(
     *      property="email",
     *      description="User email",
     *      example="some@mail.ru",
     *      type="string"
     * ),
     * @OA\Property(
     *      property="password",
     *      description="User password",
     *      example="awesomePass",
     *      type="string"
     * )
     */
    public function rules()
    {

        return [

            /** See https://www.itu.int/rec/T-REC-E.164-201011-I/en */
            'phone' => 'required_without_all:email,password|max_digits:15|min_digits:4|unique:users',

            'email' => 'required_without_all:phone|required_with:password|string|unique:users',
            'password' => 'required_without_all:phone|required_with:email|string',

        ];

    }

    public function messages()
    {
        return [
            'phone.required' => 'Поле "Телефон" является обязательным для заполнения',
            'phone.unique' => 'Пользователь с таким номером телефона уже зарегистрирован',
            'phone.max_digits' => 'Телефон не может быть больше 15 цифр',
            'phone.min_digits' => 'Телефон не может быть меньше 4 цифр',
            'email.unique' => 'Пользователь с таким email уже зарегистрирован',
            'email.required' => 'Поле "Email" является обязательным для заполнения.',
            'password.required' => 'Поле "Пароль" является обязательным для заполнения.',
        ];
    }


}
