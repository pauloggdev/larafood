<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCategory extends FormRequest
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
        $url = $this->segment(4);
        return [
            'name' => "required|min:3|max:255|unique:categories,name,{$url},url",
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'name.unique' => 'Nome já cadastrado',
        ];
    }
}
