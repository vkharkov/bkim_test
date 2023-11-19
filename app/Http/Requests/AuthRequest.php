<?php

namespace App\Http\Requests;

class AuthRequest extends ApiRequest
{


    public function rules()
    {

        return [

            /** See https://www.itu.int/rec/T-REC-E.164-201011-I/en */
            'phone' => 'required_without_all:email,password|max_digits:15|min_digits:4',

            'email' => 'required_without_all:phone|required_with:password|string',
            'password' => 'required_without_all:phone|required_with:email|string',

        ];

    }

    public function messages()
    {
        return [
            'phone.required' => 'Поле "Телефон" является обязательным для заполнения',
            'phone.max_digits' => 'Телефон не может быть больше 15 цифр',
            'phone.min_digits' => 'Телефон не может быть меньше 4 цифр',
            'email.required' => 'Поле "Email" является обязательным для заполнения.',
            'password.required' => 'Поле "Пароль" является обязательным для заполнения.',
        ];
    }

}
