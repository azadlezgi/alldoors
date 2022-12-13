<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{



    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        return [
            'username' => 'required|unique:users,username|min:3|max:255',
            'email' => 'required|email|unique:users,email|min:3|max:255',
            'roles' => 'required|exists:roles,id',
            'name' => 'required',
            'password' => 'required|min:8|max:50',
            'password_confirmation' => 'required|same:password',
        ];
    }


    public function messages()
    {
        return [

            /*   ROLES   */
            'roles.required' => 'İcazə mütləqdir.',
            'roles.exists' => 'Bu icazə sistemdə mövcud deyil.',

            /*   username   */
            'username.required' => 'İstifadəçi adı mütləqdir.',
            'username.unique' => 'Bu istifadəçi adı sistemde var, zəhmət olmasa başqa istifadəçi adı yoxlayın.',
            'username.min' => 'İstifadəçi adı minimum 3 simvol olmalıdır.',
            'username.max' => 'İstifadəçi ad maximum 255 simvol olmalıdır.',

            /*   name   */
            'name.required' => 'Ad soyad mütləqdir.',

            /*   e-mail   */
            'email.required' => 'E-mail mütləqdir.',
            'email.unique' => 'Bu e-mail adresi sistemde var, zəhmət olmasa başqa istifadəçi e-mail adresi yoxlayın.',
            'email.email' => 'Doğru e-mail formatı istifadə edin.',
            'email.min' => 'E-mail minimum 3 simvol olmalıdır.',
            'email.max' => 'E-mail maximum 255 simvol olmalıdır.',

            /*  password   */
            'password.required' => 'Şifre mütləqdir.',
            'password.min' => 'Şifre minimum 8 simvol olmalıdır.',
            'password.max' => 'Şifre maximum 50 simvol olmalıdır.',

            /*  password_confirmation   */
            'password_confirmation.required' => 'Təkrar şifrə mütləqdir.',
            'password_confirmation.same' => 'Təkrar şifrə yalnışdır',
        ];
    }





}
