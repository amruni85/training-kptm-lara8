<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //true supaya user blh guna validation request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5',
            'description' => 'required',
            'attachment' => 'required|mimes:pdf'
        ];
    }

    public function messages()
    {
        return[
            'title.required' => 'Sila isi tajuk',
            'title.min' => 'Tak cukup panjang :min',
            'description.required' => 'Sila isi penerangan'
        ];
    }
}
