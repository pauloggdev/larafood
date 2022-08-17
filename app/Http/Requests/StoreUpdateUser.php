<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUser extends FormRequest
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
        $uuid = $this->segment(4);
        return [
            'name' => "required|min:3|max:255|unique:users,name,{$uuid},uuid",
            'email' => "required|min:3|max:255"
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Nome é obrigatório',
            'email.required' => 'E-mail é obrigatório',
            'email.unique' => 'E-mail já cadastrado',
        ];
    }
}
