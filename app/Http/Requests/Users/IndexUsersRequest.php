<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class IndexUsersRequest extends FormRequest
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
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email,date_admission,active,created_at,updated_at']
        ];
    }

    /* public function messages()
    {
        return [
            'direction' => 'Asc o desc' ,
        ];
    } */

}
