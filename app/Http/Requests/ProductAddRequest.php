<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'manufacturer' => ['required','max:255'],
            'model' => ['required','max:255'],
            'code' => ['required','max:255'],
            'price' => ['required','numeric','min:0'],
            'count' => ['required','numeric','min:1'],
            'discount' => ['min:1','max:99','numeric','nullable'],
            'color' => ['required','max:255'],
            'images' => 'max:4',
            'images.*' => ['required','image','mimes:jpeg,png,jpg','max:2048'],
            'poster' => ['image','mimes:jpeg,png,jpg','max:2048'],
            'slider_slog' => ['max:255'],
            'description' => ['max:6500'],
            'highlights' => ['max:6000'],

        ];
    }
}
