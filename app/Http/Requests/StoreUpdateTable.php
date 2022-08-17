<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTable extends FormRequest
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
            'identify' => "required|min:3|max:255|unique:tables,identify,{$uuid},uuid",
            'description' => "required",
        ];
    }
    public function messages()
    {
        return [
            'identify.required' => 'identify é obrigatório',
            'description.required' => 'descrição é obrigatório',
            'identify.unique' => 'identify já cadastrado',
        ];
    }
}
