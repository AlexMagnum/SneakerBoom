<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UsersEditRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nickname' => ['required','max:255'],
            'email' => ['required','max:255','email'],
            'password' => ['min:0','max:16'],
        ];
    }
}
