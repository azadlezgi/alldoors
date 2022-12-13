<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        return [
            'email' => 'required|min:3|max:255',
            'password' => 'required|min:8|max:30',
        ];
    }


    public function messages()
    {
        return [
            'email.required' => 'E-mail boş buraxıla bilməz.',
            'email.min' => 'E-mail minimum 3 simvol olmalıdır.',
            'email.max' => 'E-mail maximum 255 simvol olmalıdır.',
            'password.required' => 'Şifrə boş buraxıla bilməz.',
            'password.min' => 'Şifrə minimum 8 simvol olmalıdır.',
            'password.max' => 'Şifrə maximum 30 simvol olmalıdır.'
        ];
    }
}
