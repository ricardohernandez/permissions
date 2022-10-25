<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'email' => 'required|max:255|unique:users,email',
            'phone' => 'required|max:25|unique:users,Phone',
            'date' => 'required|date|date_format:Y-m-d',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048', /* 'file' => 'required|csv,txt,xlx,xls,pdf|max:2048', */
        ];
    }

    public function messages()
    {
        return [
            'name.min' => 'El nombre debe tener más de :min caractéres.' ,
            'email' => 'El correo ya existe.' 
        ];
    }
}
